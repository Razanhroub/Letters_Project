<?php

namespace App\Http\Controllers;

use App\Models\PhonemeFunction;
use Illuminate\Http\Request;

class PhonemeFunctionController extends Controller
{
    // Fetch all phoneme functions (excluding soft-deleted ones)
    public function index()
    {
        $functions = PhonemeFunction::where('deleted_at', 0)
        ->with(['phoneme' => function($query) {
            $query->select('id', 'char');
        }, 'harakat' => function($query) {
            $query->select('id', 'name'); // Fetch harakat name as well
        }])
            ->get();

        if ($functions->isEmpty()) {
            return response()->json(['message' => 'No phoneme functions found'], 404);
        }

        return response()->json($functions);
    }

    // Fetch next phoneme function
    public function next($id)
    {
        $nextFunction = PhonemeFunction::where('id', '>', $id)
                                        ->where('deleted_at', 0)
                                        ->with(['phoneme' => function($query) {
                                            $query->select('id', 'char');
                                        }, 'harakat' => function($query) {
                                            $query->select('id', 'name'); // Fetch harakat name as well
                                        }])
                                        ->first();

        if (!$nextFunction) {
            return response()->json(['message' => 'No next phoneme function found'], 404);
        }

        return response()->json($nextFunction);
    }

    // Fetch previous phoneme function
    public function prev($id)
    {
        $prevFunction = PhonemeFunction::where('id', '<', $id)
                                        ->where('deleted_at', 0)
                                        ->with(['phoneme' => function($query) {
                                            $query->select('id', 'char');
                                        }, 'harakat' => function($query) {
                                            $query->select('id', 'name'); // Fetch harakat name as well
                                        }])
                                        ->orderBy('id', 'desc')
                                        ->first();

        if (!$prevFunction) {
            return response()->json(['message' => 'No previous phoneme function found'], 404);
        }

        return response()->json($prevFunction);
    }

    // Update phoneme function
    public function update(Request $request, $id)
    {
        $function = PhonemeFunction::where('id', $id)
                                   ->where('deleted_at', 0)
                                   ->first();

        if (!$function) {
            return response()->json(['message' => 'Phoneme function not found'], 404);
        }

        $function->update($request->only([
            'phoneme_id', 'harakat_id', 'position', 'grammatical_function',
            'morphological_effect', 'semantic_effect', 'examples'
        ]));

        return response()->json($function);
    }

    // Custom soft delete (mark deleted_at = 1)
    public function destroy($id)
    {
        $function = PhonemeFunction::where('id', $id)->first();

        if (!$function) {
            return response()->json(['message' => 'Phoneme function not found'], 404);
        }

        $function->update(['deleted_at' => 1]); // Mark as deleted

        return response()->json(['message' => 'Phoneme function deleted successfully']);
    }
}
