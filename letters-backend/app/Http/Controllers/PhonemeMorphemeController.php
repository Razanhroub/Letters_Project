<?php

namespace App\Http\Controllers;

use App\Models\PhonemeMorpheme;
use Illuminate\Http\Request;

class PhonemeMorphemeController extends BaseController
{
    public function __construct(){
        $this->model=PhonemeMorpheme::class;
        $this->relations = [
            'phoneme:id,char',
            'harakat:id,name'
        ];

    }
}
