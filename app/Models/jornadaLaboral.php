<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jornadaLaboral extends Model
{
    use HasFactory;

    protected $fillable= [
       'dia',
       'activo',
       'tm_inicio',
       'tm_fin',
       'tt_inicio',
       'tt_fin',
       'id_peluquero'
    ];
}
