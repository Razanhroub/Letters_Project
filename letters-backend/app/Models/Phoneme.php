<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phoneme extends Model
{
    use HasFactory;

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
    public function characteristics(){
        return $this->hasMany(PhonemeCharacteristic::class);
    }
}
