<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tratamiento;

class TratamientoController extends Controller
{
    public function peluqueros(tratamiento $tratamiento)
    {
        // dd($tratamiento->users);
       return $tratamiento->users()->where('activo',1)->get(['users.id','users.name']);
    }
}
