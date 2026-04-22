<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegiaoController extends Controller
{
    public function regiao()
    {
        return view('site.regiao.regiao');
    }
}
