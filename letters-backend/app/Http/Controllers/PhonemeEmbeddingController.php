<?php

namespace App\Http\Controllers;

use App\Models\PhonemeEmbedding;
use Illuminate\Http\Request;

class PhonemeEmbeddingController extends BaseController
{
    public function __construct(){
       $this-> model = PhonemeEmbedding::class;
       $this->relations = [
        'phoneme:id,char',
        'harakat:id,name'
    ];
    }
}
