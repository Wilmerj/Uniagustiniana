<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComunidadController extends Controller
{
    public function index()
    {
    	return view('comunidad');
    }
}
