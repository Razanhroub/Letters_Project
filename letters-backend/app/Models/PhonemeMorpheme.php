<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonemeMorpheme extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'phoneme_morphemes';
    
    // Define the fillable attributes
    protected $fillable = [
        'phoneme_id', 'harakat_id', 'structural_entity', 'formative_entity', 
        'morpheme_type', 'example_word', 'example_explanation', 'deleted_at'
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
