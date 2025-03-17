<?php

namespace App\Http\Controllers;

use App\Models\PhonemeNature;
use Illuminate\Http\Request;

class PhonemeNatureController extends BaseController
{
    public function __construct(){
        $this->model=PhonemeNature::class;
    }
}
