<?php

namespace App\Http\Controllers\Peluquero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jornadaLaboral;

class HorarioController extends Controller
{
    public function edit()
    {
        $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
        return view('horario',compact('dias'));
    }

    public function add(Request $request)
    {
        $activo = $request->input('activo') ?:[];

        $tm_inicio = $request->input('tm_inicio');

        $tm_fin = $request->input('tm_fin');

        $tt_inicio = $request->input('tt_inicio');

        $tt_fin = $request->input('tt_fin');

        for ($i=0; $i <=6 ; $i++) {
            if (in_array($i, $activo)) {
                jornadaLaboral::updateOrCreate(
                    [
                        'dia'=> $i,
                        'id_peluquero' => auth()->user()->id
                    ],
                    [
                        'activo'=> in_array($i, $activo),
                        'tm_inicio'=> $tm_inicio[$i],
                        'tm_fin'=> $tm_fin[$i],
                        'tt_inicio'=> $tt_inicio[$i],
                        'tt_fin'=> $tt_fin[$i]
                    ]
                    );
            }else{
                $aux=jornadaLaboral::where('dia' , $i)->where('id_peluquero' , auth()->user()->id)->get();
                if (isset($aux[0])) {
                    $turno=$aux[0];
                    $turno->delete();
                }
            }

        }
        return back();
    }
}
