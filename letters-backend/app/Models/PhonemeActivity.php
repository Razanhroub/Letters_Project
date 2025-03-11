<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonemeActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'phoneme_id',
        'type',
        'is_active',
        'grammatical_effect',
        'examples',
        'deleted_at', // Custom soft delete field
    ];

    // Ensure soft-deleted records are excluded by default
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
