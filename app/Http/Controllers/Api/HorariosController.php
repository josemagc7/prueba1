<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jornadaLaboral;
use App\Models\Cita;

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
        $tiempo=$request->input('tiempo');
        $horasDisponibles=jornadaLaboral::where('activo',true)->where('dia',$dia_Real_Betis)->where('id_peluquero',$id_peluquero)->first(['tm_inicio','tm_fin','tt_inicio','tt_fin']);
        // $tm_inicio = new \DateTime($horasDisponibles->tm_inicio);
        // $tm_fin = new \DateTime($horasDisponibles->tm_fin);
        $horasNoDisponible=self::horasDeshabilitadas($request);

        if (!$horasDisponibles) {
            return [];
        }

        $tm_inicio = date("H:i",strtotime($horasDisponibles->tm_inicio));
        $tm_fin =date("H:i",strtotime($horasDisponibles->tm_fin));
        $tt_inicio = date("H:i",strtotime($horasDisponibles->tt_inicio));
        $tt_fin =date("H:i",strtotime($horasDisponibles->tt_fin));

        $intervalosTM=[];
        $intervalosTT=[];

        if ($tm_inicio!='00:00' || $tm_fin!='00:00') {
            while ($tm_inicio <= $tm_fin) {
                    $interval['inicio']=$tm_inicio;
                    $tm_inicio=date('H:i',strtotime("+{$tiempo} minutes",strtotime($tm_inicio)));
                    $interval['fin']=$tm_inicio;
                    $intervalosTM[]=$interval;
            }
        }


        if ($tt_inicio!='00:00' || $tt_fin!='00:00') {
            while ($tt_inicio <= $tt_fin) {

                    $interval['inicio']=$tt_inicio;
                    $tt_inicio=date('H:i',strtotime("+{$tiempo} minutes",strtotime($tt_inicio)));
                    $interval['fin']=$tt_inicio;
                    $intervalosTT[]=$interval;

            }
        }

        foreach ($intervalosTM as $key => $value) {
            foreach ($horasNoDisponible as $clave => $valor) {
                $inicio = trim($valor['inicio']);
                $fin = trim($valor['fin']);

                if ($value['inicio'] >= $inicio && $value['inicio'] < $fin) {
                    unset($intervalosTM[$key]);
                    break;
                } elseif ($value['fin'] > $inicio && $value['fin'] <= $fin) {
                    unset($intervalosTM[$key]);
                    break;
                }elseif ($inicio >= $value['inicio'] && $inicio < $value['fin']) {
                    unset($intervalosTM[$key]);
                    break;
                }elseif ($fin > $value['inicio'] && $fin <= $value['fin']) {
                    unset($intervalosTM[$key]);
                    break;
                }
            }
        }
        foreach ($intervalosTT as $key => $value) {
            foreach ($horasNoDisponible as $clave => $valor) {
                $inicio = trim($valor['inicio']);
                $fin = trim($valor['fin']);

                if ($value['inicio'] >= $inicio && $value['inicio'] < $fin) {
                    unset($intervalosTT[$key]);
                    break;
                }
                 elseif ($value['fin'] > $inicio && $value['fin'] <= $fin) {
                    unset($intervalosTT[$key]);
                    break;
                }elseif ($inicio >= $value['inicio'] && $inicio < $value['fin']) {
                    unset($intervalosTT[$key]);
                    break;
                }elseif ($fin > $value['inicio'] && $fin <= $value['fin']) {
                    unset($intervalosTT[$key]);
                    break;
                }
            }
        }
        // foreach ($intervalosTT as $key => $value) {
        //     foreach ($horasNoDisponible as $clave => $valor) {
        //         if ($value['inicio'] > $valor['inicio'] && $value['inicio']< $valor['fin']) {
        //             unset($intervalosTT[$key]);
        //         }elseif ($value['fin'] > $valor['inicio'] && $value['fin']< $valor['fin']) {
        //             unset($intervalosTT[$key]);
        //         }
        //     }
        // }
       $data=[];
       sort($intervalosTM);
       sort($intervalosTT);
       $data['TM']=$intervalosTM;
       $data['TT']=$intervalosTT;

        // dd($data);
       return $data;

    }

    public function horasDeshabilitadas(Request $request){
        $rules=[
            'fecha'=>'required|date_format:"Y-m-d"',
            'id_peluquero'=>'required|exists:users.id'
        ];

        $fecha= $request->input('fecha');
        // dd($fecha);
        // $dia=date('N',strtotime($fecha));
        // $dia_Real_Betis=$dia-1;
        $id_peluquero=$request->input('id_peluquero');

        $horasNOdisponibles=Cita::where('fecha_cita',$fecha)->where('peluquero_id',$id_peluquero)->get(['hora_cita']);

        if (!$horasNOdisponibles) {
            return [];
        }
        $arrayNodisponible=[];
        foreach ($horasNOdisponibles as $key => $value) {
            // $arrayNodisponible[$value["hora_cita"]]=$value["hora_cita"];
            $horaIncicioCita=explode(' -',$value["hora_cita"]);

            $arrayNodisponible[$key]['inicio']=$horaIncicioCita[0];
            $arrayNodisponible[$key]['fin']=$horaIncicioCita[1];
        }
        return $arrayNodisponible;
        // $horasDisponibles=jornadaLaboral::where('activo',true)->where('dia',$dia_Real_Betis)->where('id_peluquero',$id_peluquero)->first(['tm_inicio','tm_fin','tt_inicio','tt_fin']);
    }
}
