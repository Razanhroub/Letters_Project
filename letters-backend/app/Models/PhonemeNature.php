<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhonemeNature extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'phoneme_natures';

    // Define the fillable attributes
    protected $fillable = [
        'word',
        'root',
        'is_original',
        'deleted_at',
    ];

    // Relationship with Phoneme model
    public function phoneme()
    {
        return $this->belongsTo(Phoneme::class);
    }
}
