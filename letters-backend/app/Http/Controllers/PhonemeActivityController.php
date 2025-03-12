<?php

namespace App\Http\Controllers;

use App\Models\PhonemeActivity;
use Illuminate\Http\Request;

class PhonemeActivityController extends Controller
{
    public function index()
{
    $activity = PhonemeActivity::where('deleted_at', 0)
        ->with(['phoneme' => function($query) {
            $query->select('id', 'char'); 
        }])
        ->first();
        // dd($activity);
    if (!$activity) {
        return response()->json(['message' => 'No activity found'], 404);
    }

    return response()->json($activity);
}




    public function next($id)
    {
        $nextActivity = PhonemeActivity::where('id', '>', $id)
            ->where('deleted_at', 0)
            ->with('phoneme:char')
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
            ->with('phoneme:char')
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

        $activity->update(['deleted_at' => 1]);

        return response()->json(['message' => 'Activity deleted successfully']);
    }
}
