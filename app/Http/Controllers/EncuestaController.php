<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    public function encuesta(){
    	return view('encuesta');
    }
}
