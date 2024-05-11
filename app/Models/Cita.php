<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable =[
        'tratamiento_id',
        'peluquero_id',
        'cliente_id',
        'fecha_cita',
        'hora_cita',
        'descripcion',
        'tratamiento',
        'precio',
        'tiempo'
    ];
}
