<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phoneme extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'char',
        'Symbol',
        'Type',
        'Voicing',
        'PlaceManner',
        'Duration',
        'windows_1256_hex',
        'windows_1256_decimal',
        'unicode_hex',
        'unicode_decimal',
    ];

    public function activities()
    {
        return $this->hasMany(PhonemeActivity::class);
    }
}
