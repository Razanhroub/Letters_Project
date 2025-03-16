<?php

namespace App\Http\Controllers;

use App\Models\PhonemeContextualFeature;
use Illuminate\Http\Request;
use Log;

class PhonemeContextualFeatureController extends Controller
{
    // Fetch all phoneme contextual features (excluding soft-deleted ones)
    public function index()
    {
        $features = PhonemeContextualFeature::where('deleted_at', 0)
            ->with(['phoneme' => function($query) {
                $query->select('id', 'char');
            }, 'harakat' => function($query) {
                $query->select('id', 'name'); // Fetch harakat name as well
            }])
            ->get();

        if ($features->isEmpty()) {
            return response()->json(['message' => 'No contextual features found'], 404);
        }

        return response()->json($features);
    }

    // Fetch next phoneme contextual feature
    public function next($id)
    {
        $nextFeature = PhonemeContextualFeature::where('id', '>', $id)
                                                ->where('deleted_at', 0)
                                                ->first();

        if (!$nextFeature) {
            return response()->json(['message' => 'No next contextual feature found'], 404);
        }

        return response()->json($nextFeature);
    }

    // Fetch previous phoneme contextual feature
    public function prev($id)
    {
        $prevFeature = PhonemeContextualFeature::where('id', '<', $id)
                                                ->where('deleted_at', 0)
                                                ->orderBy('id', 'desc')
                                                ->first();

        if (!$prevFeature) {
            return response()->json(['message' => 'No previous contextual feature found'], 404);
        }

        return response()->json($prevFeature);
    }

    // Update phoneme contextual feature
    public function update(Request $request, $id)
    {
        $feature = PhonemeContextualFeature::where('id', $id)
                                           ->where('deleted_at', 0)
                                           ->first();

        if (!$feature) {
            return response()->json(['message' => 'Contextual feature not found'], 404);
        }

        $feature->update($request->only([
            'phoneme_id', 'harakat_id', 'position', 'contextual_effect',
            'phonetic_change', 'semantic_change', 'examples'
        ]));

        return response()->json($feature);
    }

    // Custom soft delete (mark deleted_at = 1)
    public function destroy($id)
    {
        $feature = PhonemeContextualFeature::where('id', $id)->first();

        if (!$feature) {
            return response()->json(['message' => 'Contextual feature not found'], 404);
        }

        $feature->update(['deleted_at' => 1]); // Mark as deleted

        return response()->json(['message' => 'Contextual feature deleted successfully']);
    }
}
