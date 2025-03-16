<?php

namespace App\Http\Controllers;

use App\Models\PhonemeGrammaticalRole;
use Illuminate\Http\Request;

class PhonemeGrammaticalRoleController extends BaseController
{
    public function __construct(){
        $this->model=PhonemeGrammaticalRole::class;
        $this->relations = [
            'phoneme:id,char',
            'harakat:id,name'
        ];

    }
}
