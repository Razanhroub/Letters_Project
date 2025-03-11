<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class PhonemeActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'phoneme_id',
        'type',
        'is_active',
        'grammatical_effect',
        'examples',
        // 'is_deleted',  // Allow 'is_deleted' to be mass-assigned
        
    ];

    // protected $casts = [
    //     'is_deleted' => 'boolean',  // Make sure 'is_deleted' is cast to a boolean
    // ];

    public function phoneme()
    {
        return $this->belongsTo(Phoneme::class);
    }
}
