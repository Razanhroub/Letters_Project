<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonemeEmbedding extends Model
{
    use HasFactory;

    protected $table = 'phoneme_embeddings';

    protected $fillable = [
        'phoneme_id', 'harakat_id', 'position', 'embedding_effect', 
        'phonetic_effect', 'semantic_change', 'examples', 'deleted_at'
    ];

    protected $casts = [
        'deleted_at' => 'boolean',
    ];

    public function phoneme()
    {
        return $this->belongsTo(Phoneme::class);
    }

    public function harakat()
    {
        return $this->belongsTo(Harakat::class);
    }
}
