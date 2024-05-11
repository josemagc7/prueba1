<?php

namespace App\Http\Controllers\Peluquero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jornadaLaboral;

class HorarioController extends Controller
{
    private $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
    public function edit()
    {

        $diasTrabajo=jornadaLaboral::where('id_peluquero' , auth()->user()->id)->get()->toArray();
        $jornada=$diasTrabajo;
        // dd($diasTrabajo);
        // foreach ($diasTrabajo as $key => $value) {
        //    $aux[$value['dia']]=$diasTrabajo[$key];
        // }
        // dd($aux);
        // foreach ($dias as $key => $value) {
        //     if (isset($aux[$key])) {
        //         $jornada[$key]= $aux[$key];
        //     }else{
        //         $jornada[$key]=[
        //             "dia" => $key,
        //             "activo" => 0,
        //             "tm_inicio" => "00:00:00",
        //             "tm_fin" => "00:00:00",
        //             "tt_inicio" => "00:00:00",
        //             "tt_fin" => "00:00:00",
        //             "id_peluquero" => auth()->user()->id
        //         ];
        //     }
        // }

        foreach ($jornada as $key => $value) {
            $jornada[$key]["tm_inicio"] = date('G:i',strtotime($jornada[$key]["tm_inicio"]));
            $jornada[$key]["tm_fin"] = date('G:i',strtotime($jornada[$key]["tm_fin"]));
            $jornada[$key]["tt_inicio"] = date('G:i',strtotime($jornada[$key]["tt_inicio"]));
            $jornada[$key]["tt_fin"] = date('G:i',strtotime($jornada[$key]["tt_fin"]));
        }
        // dd($jornada);
        $dias= $this->dias;
        return view('horario',compact('jornada','dias'));
    }

    public function add(Request $request)
    {

        $dias=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];

        $activo = $request->input('activo') ?:[];

        $tm_inicio = $request->input('tm_inicio');

        $tm_fin = $request->input('tm_fin');

        $tt_inicio = $request->input('tt_inicio');

        $tt_fin = $request->input('tt_fin');

        $errores_horario=[];
        for ($i=0; $i <=6 ; $i++) {
            if (in_array($i, $activo)) {

                if ($tm_inicio[$i] > $tm_fin[$i] ) {
                    $errores_horario[]="Las horas del turno mañana del dia {$this->dias[$i]} son incoherentes.";
                }

                if ($tt_inicio[$i] > $tt_fin[$i]) {
                    $errores_horario[]="Las horas del turno tarde del dia {$this->dias[$i]} son incoherentes.";
                }
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
                }
            else{
                jornadaLaboral::updateOrCreate(
                    [
                        'dia'=> $i,
                        'id_peluquero' => auth()->user()->id
                    ],
                    [
                        'activo'=> 0,
                        'tm_inicio'=> '00:00:00',
                        'tm_fin'=> '00:00:00',
                        'tt_inicio'=> '00:00:00',
                        'tt_fin'=> '00:00:00'
                    ]
                    );
                }
            }
            if (count($_POST) == 1 ) {
                return back();
            }
            if (count($errores_horario)>0) {
                return back()->with(compact('errores_horario'));
            }else{
                $mensaje='Cambios realizado correctamente.';
                return back()->with(compact('mensaje'));
            }

        }
    }

