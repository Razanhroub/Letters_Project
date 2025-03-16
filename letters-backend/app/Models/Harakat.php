<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harakat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol',
        'description',
        'deleted_at', // Manual soft delete (0 = active, 1 = deleted)
    ];

    // Ensure soft-deleted records are excluded by default
    protected static function booted()
    {
        static::addGlobalScope('notDeleted', function ($query) {
            $query->where('deleted_at', 0);
        });
    }

    // Define relationship with PhonemeContextualFeature
    public function phonemeContextualFeatures()
    {
        return $this->hasMany(PhonemeContextualFeature::class, 'harakat_id');
    }
}
