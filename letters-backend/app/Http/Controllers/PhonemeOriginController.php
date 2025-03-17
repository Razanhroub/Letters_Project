<?php

namespace App\Http\Controllers;

use App\Models\PhonemeOrigin;
use Illuminate\Http\Request;

class PhonemeOriginController extends BaseController
{
    public function __construct(){
        $this->model=PhonemeOrigin::class;
        $this->relations = [
            'phoneme:id,char'
        ] ;
    }
}
