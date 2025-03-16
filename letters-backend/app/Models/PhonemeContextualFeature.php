<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonemeContextualFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'phoneme_id',
        'harakat_id',
        'position',
        'contextual_effect',
        'phonetic_change',
        'semantic_change',
        'examples',
        'deleted_at',
    ];

    // Ensure soft-deleted records are excluded by default
    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function ($query) {
            $query->where('deleted_at', 0);
        });
    }

    // Define the relationship with phonemes
    public function phoneme()
    {
        return $this->belongsTo(Phoneme::class, 'phoneme_id');
    }

    // Define the relationship with harakats
    public function harakat()
    {
        return $this->belongsTo(Harakat::class, 'harakat_id');
    }
}
