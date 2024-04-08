<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jornadaLaboral;

class HorariosController extends Controller
{
    public function horas(Request $request){
        $rules=[
            'fecha'=>'required|date_format:"Y-m-d"',
            'id_peluquero'=>'required|exists:users.id'
        ];
        // $fecha=$request->input('fecha');
        $fecha= $request->input('fecha');
        $dia=date('N',strtotime($fecha));
        $dia_Real_Betis=$dia-1;
        $id_peluquero=$request->input('id_peluquero');

        $horasDisponibles=jornadaLaboral::where('activo',true)->where('dia',$dia_Real_Betis)->where('id_peluquero',$id_peluquero)->first(['tm_inicio','tm_fin','tt_inicio','tt_fin']);
        // $tm_inicio = new \DateTime($horasDisponibles->tm_inicio);
        // $tm_fin = new \DateTime($horasDisponibles->tm_fin);

        $tm_inicio = date("H:i",strtotime($horasDisponibles->tm_inicio));
        $tm_fin =date("H:i",strtotime($horasDisponibles->tm_fin));
        $tt_inicio = date("H:i",strtotime($horasDisponibles->tt_inicio));
        $tt_fin =date("H:i",strtotime($horasDisponibles->tt_fin));

        $intervalosTM=[];
        $intervalosTT=[];

        if ($tm_inicio!='00:00' || $tm_fin!='00:00') {
            while ($tm_inicio <= $tm_fin) {
                $interval['inicio']=$tm_inicio;
                $tm_inicio=date('H:i',strtotime("+30 minutes",strtotime($tm_inicio)));
                $interval['fin']=$tm_inicio;
                $intervalosTM[]=$interval;
            }
        }


        if ($tt_inicio!='00:00' || $tt_fin!='00:00') {
            while ($tt_inicio <= $tt_fin) {
                $interval['inicio']=$tt_inicio;
                $tt_inicio=date('H:i',strtotime("+30 minutes",strtotime($tt_inicio)));
                $interval['fin']=$tt_inicio;
                $intervalosTT[]=$interval;
            }
        }

       $data=[];
       $data['TM']=$intervalosTM;
       $data['TT']=$intervalosTT;
       return $data;

    }
}
