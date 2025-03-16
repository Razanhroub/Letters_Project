<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonemeGrammaticalRole extends Model
{
    use HasFactory;

    protected $table = 'phoneme_grammatical_roles';
    
    protected $fillable = [
        'phoneme_id', 'harakat_id', 'position', 'grammatical_role', 
        'grammatical_change', 'examples', 'deleted_at'
    ];

    // Relationship with Phoneme model
    public function phoneme()
    {
        return $this->belongsTo(Phoneme::class);
    }

    // Relationship with Harakat model
    public function harakat()
    {
        return $this->belongsTo(Harakat::class);
    }
}
