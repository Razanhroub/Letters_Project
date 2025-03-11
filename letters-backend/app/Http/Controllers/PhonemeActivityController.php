<?php
namespace App\Http\Controllers;

use App\Models\PhonemeActivity;
use Illuminate\Http\Request;
use Log;

class PhonemeActivityController extends Controller
{
    // Fetch all activities (excluding soft-deleted ones)
    public function index()
    {
        return PhonemeActivity::where('deleted_at', 0)->get();
    }

    public function next($id)
    {
        $nextActivity = PhonemeActivity::where('id', '>', $id)
                                        ->where('deleted_at', 0)
                                        ->first();

        if (!$nextActivity) {
            return response()->json(['message' => 'No next activity found'], 404);
        }

        return response()->json($nextActivity);
    }

    public function prev($id)
    {
        $prevActivity = PhonemeActivity::where('id', '<', $id)
                                        ->where('deleted_at', 0)
                                        ->orderBy('id', 'desc')
                                        ->first();

        if (!$prevActivity) {
            return response()->json(['message' => 'No previous activity found'], 404);
        }

        return response()->json($prevActivity);
    }

    public function update(Request $request, $id)
    {
        $activity = PhonemeActivity::where('id', $id)
                                    ->where('deleted_at', 0)
                                    ->first();

        if (!$activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }

        $activity->update($request->only(['type', 'is_active', 'grammatical_effect', 'examples']));
        return response()->json($activity);
    }

    // Custom soft delete (mark deleted_at = 1)
    public function destroy($id)
    {
        $activity = PhonemeActivity::where('id', $id)->first();

        if (!$activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }

        $activity->update(['deleted_at' => 1]); // Mark as deleted

        return response()->json(['message' => 'Activity deleted successfully']);
    }

    // Restore a soft-deleted activity
    public function restore($id)
    {
        \Log::info("Attempting to restore activity with ID: " . $id);
    
        // Fetch the activity where deleted_at is 1
        $activity = PhonemeActivity::where('id', $id)->where('deleted_at', 1)->first();
    
        \Log::info("Database query result for ID {$id}: ", ['activity' => $activity]);
    
        if (!$activity) {
            \Log::warning("Activity with ID: " . $id . " not found or not soft-deleted.");
            return response()->json(['message' => 'Activity not found or not soft-deleted'], 404);
        }
    
        // Restore activity (set deleted_at to 0)
        $activity->update(['deleted_at' => 0]);
    
        \Log::info("Activity with ID: " . $id . " restored successfully.");
    
        return response()->json(['message' => 'Activity restored successfully']);
    }
    
    
    
    
    
}
