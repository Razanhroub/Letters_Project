<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonemeFunction extends Model
{
    use HasFactory;

    protected $fillable = [
        'phoneme_id',
        'harakat_id',
        'position',
        'grammatical_function',
        'morphological_effect',
        'semantic_effect',
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

    // Define relationships
    public function phoneme()
    {
        return $this->belongsTo(Phoneme::class);
    }

    public function harakat()
    {
        return $this->belongsTo(Harakat::class);
    }
}
