<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tratamiento;

class CitaController extends Controller
{
    public function create()
        {
            $tratamientos=tratamiento::all();
            return view('citas.create',compact('tratamientos'));
        }
}


