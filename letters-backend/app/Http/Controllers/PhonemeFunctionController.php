<?php

namespace App\Http\Controllers;

use App\Models\PhonemeFunction;

class PhonemeFunctionController extends BaseController
{
    public function __construct()
    {
        $this->model = PhonemeFunction::class;
        $this->relations = [
            'phoneme:id,char',
            'harakat:id,name'
        ];
    }
}
