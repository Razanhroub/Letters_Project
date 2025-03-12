<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonemeCharacteristic extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'phoneme_id',
        'position',
        'place_of_articulation',
        'manner_of_articulation',
        'voiced',
        'emphasis',
        'duration',
        'pitch',
        'independent_or_connected',
        'pressure_level',
        'resonance_frequency',
        'force_and_depth',
        'phonetic_influence',
        'extra_or_original',
        'articulation_influence',
        'consonant_or_vowel',
        'deleted_at',
    ];

    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function ($query) {
            $query->where('deleted_at', 0);
        });
    }

    public function phoneme()
    {
        return $this->belongsTo(Phoneme::class);
    }
}
