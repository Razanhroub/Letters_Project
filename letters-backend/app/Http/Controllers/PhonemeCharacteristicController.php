<?php

namespace App\Http\Controllers;

use App\Models\PhonemeCharacteristic;
use Illuminate\Http\Request;
use Log;

class PhonemeCharacteristicController extends Controller
{
    // Fetch all phoneme characteristics (excluding soft-deleted ones)
    public function index()
    {
        return PhonemeCharacteristic::where('deleted_at', 0)->get();
    }

    public function next($id)
    {
        $nextCharacteristic = PhonemeCharacteristic::where('id', '>', $id)
                                                    ->where('deleted_at', 0)
                                                    ->first();

        if (!$nextCharacteristic) {
            return response()->json(['message' => 'No next characteristic found'], 404);
        }

        return response()->json($nextCharacteristic);
    }

    public function prev($id)
    {
        $prevCharacteristic = PhonemeCharacteristic::where('id', '<', $id)
                                                    ->where('deleted_at', 0)
                                                    ->orderBy('id', 'desc')
                                                    ->first();

        if (!$prevCharacteristic) {
            return response()->json(['message' => 'No previous characteristic found'], 404);
        }

        return response()->json($prevCharacteristic);
    }

    public function update(Request $request, $id)
    {
        $characteristic = PhonemeCharacteristic::where('id', $id)
                                               ->where('deleted_at', 0)
                                               ->first();

        if (!$characteristic) {
            return response()->json(['message' => 'Characteristic not found'], 404);
        }

        $characteristic->update($request->only([
            'position', 'place_of_articulation', 'manner_of_articulation',
            'voiced', 'emphasis', 'duration', 'pitch', 'independent_or_connected',
            'pressure_level', 'resonance_frequency', 'force_and_depth',
            'phonetic_influence', 'extra_or_original', 'articulation_influence',
            'consonant_or_vowel'
        ]));

        return response()->json($characteristic);
    }

    // Custom soft delete (mark deleted_at = 1)
    public function destroy($id)
    {
        $characteristic = PhonemeCharacteristic::where('id', $id)->first();

        if (!$characteristic) {
            return response()->json(['message' => 'Characteristic not found'], 404);
        }

        $characteristic->update(['deleted_at' => 1]); // Mark as deleted

        return response()->json(['message' => 'Characteristic deleted successfully']);
    }
}
