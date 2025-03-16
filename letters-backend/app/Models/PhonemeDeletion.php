<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonemeDeletion extends Model
{
    use HasFactory;

    protected $fillable = [
        'phoneme_id',
        'deleted_letter',
        'deletion_cause',
        'effect',
        'examples',
        'notes',
        'deleted_at',
    ];

    public function phoneme()
    {
        return $this->belongsTo(Phoneme::class, 'phoneme_id');
    }

    // Ensure soft-deleted records are excluded by default
    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function ($query) {
            $query->where('deleted_at', 0);
        });
    }
}
