<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\User;



class ChartsController extends Controller
{
    public function citas(){
        return view('charts.citas');
    }

    public function topPeluquero(){
        return view('charts.topPeluquero');
    }

    public function getDataCitas(){


        switch ($_REQUEST['frecuencia']) {
            case 'diaria':
                $fechaInicio = $_REQUEST['fechaInicio'];
                $fechaFin = $_REQUEST['fechaFin'];

                $labels = [];
                $currentDate = $fechaInicio;
                while (strtotime($currentDate) <= strtotime($fechaFin)) {
                    $currentDate = date('d-m-Y', strtotime($currentDate));
                    $labels[] = $currentDate;
                    $currentDate = date('d-m-Y', strtotime($currentDate . ' +1 day'));
                }

                break;

            case 'semanal':
                $fechaInicio = date("Y-m-d", strtotime("{$_REQUEST['fechaInicio']}"));
                $fechaFin = date("Y-m-d", strtotime("{$_REQUEST['fechaFin']}" . ' +6 day'));

                $labels = [];
                $currentDate = $fechaInicio;
                while (strtotime($currentDate) <= strtotime($fechaFin)) {
                    $semana = date("W-o", strtotime($currentDate));
                    if (!in_array($semana, $labels)) {
                        $labels[] = $semana;
                    }
                    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 week'));
                }

                break;

            case 'mensual':
                $fechaInicio = $_REQUEST['fechaInicio'] . "-01";
                $fechaFin = date("Y-m-t", strtotime($_REQUEST['fechaFin']));

                $labels = [];
                $currentDate = $fechaInicio;
                while (strtotime($currentDate) <= strtotime($fechaFin)) {
                    $mes = date("m-Y", strtotime($currentDate));
                    if (!in_array($mes, $labels)) {
                        $labels[] = $mes;
                    }
                    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 month'));
                }

                break;

            default:
                // Manejar caso por defecto si es necesario
                break;
        }
        $data=[];
        foreach ($labels as $key => $value) {
            $data[$value]['CitasTotal'] = 0;
            $data[$value]['CitasCanceladas'] = 0;
            $data[$value]['CitasOk'] = 0;
        }
        $citas = Cita::whereBetween('fecha_cita', [$fechaInicio, $fechaFin])->get();
        foreach ($citas as $cita) {
            $fechaCita = $cita['fecha_cita'];


            switch ($_REQUEST['frecuencia']) {
                case 'diaria':
                    $key = date('d-m-Y',strtotime($fechaCita));
                    break;

                case 'semanal':
                    $key = date("W-o", strtotime($fechaCita));
                    break;

                case 'mensual':
                    $key = date("m-Y", strtotime($fechaCita));
                    break;

                default:
                    $key = null;
                    break;
            }

            if ($key && isset($data[$key])) {
                $data[$key]['CitasTotal'] += 1;
                if ($cita['asistencia'] == 1) {
                    $data[$key]['CitasOk'] += 1;
                } else {
                    $data[$key]['CitasCanceladas'] += 1;
                }
            }
        }
        $datos=[];
        $i=0;
        foreach ($data as $key => $value) {
            $datos['total'][$i]=$value['CitasTotal'];
            $datos['completadas'][$i]=$value['CitasOk'];
            $datos['canceladas'][$i]=$value['CitasCanceladas'];
            $i++;
        }
        $datos['labels']=$labels;

        return $datos;
    }

    public function getDataTop(){


        switch ($_REQUEST['frecuencia']) {
            case 'diaria':
                $fechaInicio = $_REQUEST['fechaInicio'];
                $fechaFin = $_REQUEST['fechaFin'];

                $labels = [];
                $currentDate = $fechaInicio;
                while (strtotime($currentDate) <= strtotime($fechaFin)) {
                    $currentDate = date('d-m-Y', strtotime($currentDate));
                    $labels[] = $currentDate;
                    $currentDate = date('d-m-Y', strtotime($currentDate . ' +1 day'));
                }

                break;

            case 'semanal':
                $fechaInicio = date("Y-m-d", strtotime("{$_REQUEST['fechaInicio']}"));
                $fechaFin = date("Y-m-d", strtotime("{$_REQUEST['fechaFin']}" . ' +6 day'));

                $labels = [];
                $currentDate = $fechaInicio;
                while (strtotime($currentDate) <= strtotime($fechaFin)) {
                    $semana = date("W-o", strtotime($currentDate));
                    if (!in_array($semana, $labels)) {
                        $labels[] = $semana;
                    }
                    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 week'));
                }

                break;

            case 'mensual':
                $fechaInicio = $_REQUEST['fechaInicio'] . "-01";
                $fechaFin = date("Y-m-t", strtotime($_REQUEST['fechaFin']));

                $labels = [];
                $currentDate = $fechaInicio;
                while (strtotime($currentDate) <= strtotime($fechaFin)) {
                    $mes = date("m-Y", strtotime($currentDate));
                    if (!in_array($mes, $labels)) {
                        $labels[] = $mes;
                    }
                    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 month'));
                }

                break;

            default:
                // Manejar caso por defecto si es necesario
                break;
        }
        $data=[];
        $datos=[];
        foreach ($labels as $key => $value) {
            $data[$value]['CitasTotal'] = 0;
            $data[$value]['CitasCanceladas'] = 0;
            $data[$value]['CitasOk'] = 0;
        }
        $citas = Cita::whereBetween('fecha_cita', [$fechaInicio, $fechaFin])->where('asistencia',1)->get();
        $data = [];
        foreach ($citas as $cita) {
            $clientes= User::where('id' , $cita['peluquero_id'])->get();
            $usuario = $clientes->first();

            isset($data[$usuario->name])?$data[$usuario->name]++:$data[$usuario->name] = 1;
            // $data[$clientes['name']]
        }

        arsort($data);
        if (count($data) > 10) {
            $data = array_slice($data, 0, 10);
        }

        $i=0;
        foreach ($data as $key => $value) {
            $datos['labels'][$i]=$key;
            $datos['data'][$i]=$value;
            $i++;
        }

        return $datos;
    }
}


