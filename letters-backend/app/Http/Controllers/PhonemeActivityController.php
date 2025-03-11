<?php
namespace App\Http\Controllers;

use App\Models\PhonemeActivity;
use Illuminate\Http\Request;

class PhonemeActivityController extends Controller
{
    public function show($id)
    {
        $activity = PhonemeActivity::find($id); 
            dd($activity); 
        try {
            // Just fetching by ID, no filtering by 'is_deleted'
            if (!$activity) {
                return response()->json(['message' => 'Activity not found'], 404);
            }
            return response()->json($activity);
        } catch (\Exception $e) {
            \Log::error('Error fetching phoneme activity: ' . $e->getMessage());
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
    
    public function next($id)
    {
        // Removing the 'is_deleted' condition for now
        $nextActivity = PhonemeActivity::with('phoneme')
            ->where('id', '>', $id)
            ->first();

        if (!$nextActivity) {
            return response()->json(['message' => 'No next activity found'], 404);
        }

        return response()->json($nextActivity);
    }

    public function prev($id)
    {
        // Removing the 'is_deleted' condition for now
        $prevActivity = PhonemeActivity::with('phoneme')
            ->where('id', '<', $id)
            ->orderBy('id', 'desc')
            ->first();

        if (!$prevActivity) {
            return response()->json(['message' => 'No previous activity found'], 404);
        }

        return response()->json($prevActivity);
    }

    public function update(Request $request, $id)
    {
        $activity = PhonemeActivity::find($id);
        if (!$activity) {
            return response()->json(['message' => 'Activity not found'], 404);
        }
        $activity->update($request->only(['type', 'is_active', 'grammatical_effect', 'examples']));
        return response()->json($activity);
    }

    // public function softDelete($id)
    // {
    //     $activity = PhonemeActivity::find($id);

    //     if (!$activity) {
    //         return response()->json(['message' => 'Activity not found'], 404);
    //     }

    //     $activity->update(['is_deleted' => 1]);

    //     return response()->json(['message' => 'Activity deleted successfully']);
    // }
}
