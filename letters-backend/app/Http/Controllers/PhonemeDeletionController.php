<?php

namespace App\Http\Controllers;

use App\Models\PhonemeDeletion;
use Illuminate\Http\Request;

class PhonemeDeletionController extends Controller
{
    // Fetch all phoneme deletions (excluding soft-deleted ones)
    public function index()
    {
        $deletions = PhonemeDeletion::where('deleted_at', 0)
            ->with(['phoneme' => function ($query) {
                $query->select('id', 'char');
            }])
            ->get();

        if ($deletions->isEmpty()) {
            return response()->json(['message' => 'No phoneme deletions found'], 404);
        }

        return response()->json($deletions);
    }

    // Fetch next phoneme deletion
    public function next($id)
    {
        $nextDeletion = PhonemeDeletion::where('id', '>', $id)
            ->where('deleted_at', 0)
            ->with(['phoneme' => function ($query) {
                $query->select('id', 'char');
            }])
            ->first();

        if (!$nextDeletion) {
            return response()->json(['message' => 'No next deletion found'], 404);
        }

        return response()->json($nextDeletion);
    }

    // Fetch previous phoneme deletion
    public function prev($id)
    {
        $prevDeletion = PhonemeDeletion::where('id', '<', $id)
            ->where('deleted_at', 0)
            ->with(['phoneme' => function ($query) {
                $query->select('id', 'char');
            }])
            ->orderBy('id', 'desc')
            ->first();

        if (!$prevDeletion) {
            return response()->json(['message' => 'No previous deletion found'], 404);
        }

        return response()->json($prevDeletion);
    }

    // Update phoneme deletion
    public function update(Request $request, $id)
    {
        $deletion = PhonemeDeletion::where('id', $id)
            ->where('deleted_at', 0)
            ->first();

        if (!$deletion) {
            return response()->json(['message' => 'Phoneme deletion not found'], 404);
        }

        $deletion->update($request->only([
            'phoneme_id', 'deleted_letter', 'deletion_cause',
            'effect', 'examples', 'notes'
        ]));

        return response()->json($deletion);
    }

    // Custom soft delete (mark deleted_at = 1)
    public function destroy($id)
    {
        $deletion = PhonemeDeletion::where('id', $id)->first();

        if (!$deletion) {
            return response()->json(['message' => 'Phoneme deletion not found'], 404);
        }

        $deletion->update(['deleted_at' => 1]); // Mark as deleted

        return response()->json(['message' => 'Phoneme deletion deleted successfully']);
    }
}
