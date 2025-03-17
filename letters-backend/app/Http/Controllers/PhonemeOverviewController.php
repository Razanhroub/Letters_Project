<?php

namespace App\Http\Controllers;

use App\Models\PhonemeActivity;
use App\Models\PhonemeCharacteristic;
use App\Models\PhonemeContextualFeature;
use App\Models\PhonemeDeletion;
use App\Models\PhonemeEmbedding;
use App\Models\PhonemeFunction;
use Illuminate\Http\Request;
use App\Models\PhonemeNature;
use App\Models\PhonemeOrigin;
use App\Models\PhonemeGrammaticalRole;
use App\Models\PhonemeMorpheme;

class PhonemeOverviewController extends Controller
{
    public function index(){
        return response()->json([
            'phoneme_natures' => PhonemeNature::all(),
            'phoneme_origins' => PhonemeOrigin::all(),
            'phoneme_grammatical_roles' => PhonemeGrammaticalRole::all(),
            'phoneme_morphemes' => PhonemeMorpheme::all(),
            'phoneme_functions' => PhonemeFunction::all(),
            'phoneme_characteristics'=> PhonemeCharacteristic::all(),
            'phoneme_activities'=> PhonemeActivity::all(),
            'phoneme_contextual_features'=> PhonemeContextualFeature::all(),
            'phoneme_deletions'=> PhonemeDeletion::all(),
            'phoneme_embeddings'=> PhonemeEmbedding::all(),
        ]);
    }
}
