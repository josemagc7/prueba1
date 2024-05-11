<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tratamiento;
use App\Models\cita;
use App\Models\User;

class CitaController extends Controller
{
    public function create()
        {
            $tratamientos=tratamiento::where('activo',1)->get();


            return view('citas.create',compact('tratamientos'));
        }



        public function add(Request $request)
        {
            $rules=[
                'tratamiento_id'=>'exists:tratamientos,id',
                'peluquero_id'=>'exists:users,id',
                // 'fecha_cita',
                'hora_cita'=>'required',
            ];

            $messages=[
                'hora_cita.required' => 'Seleccione una hora valida para su cita.'
            ];
            $this->validate($request,$rules,$messages);

            $tratamiento_id =explode('-',$request['tratamiento_id']) ;
            $tratamientos=tratamiento::where('id',$tratamiento_id[0])->get();

            $data= $request->only([
                'peluquero_id',
                'fecha_cita',
                'hora_cita',
                'descripcion'
            ]);
            $data['cliente_id']=auth()->id();
            $data['tratamiento_id']=$tratamiento_id[0];
            $data['precio']=$tratamientos[0]['precio'];
            $data['tiempo']=$tratamientos[0]['tiempo'];
            $data['tratamiento']=$tratamientos[0]['tratamiento'];
            // dd($data);
            cita::create($data);
            $mensaje='La cita ha sido registrada correctamente.';
            return back()->with(compact('mensaje'));
            // return redirect('/citas)
        }

        public function vercitas()
        {
            $data=[];
            $citas=cita::where('cliente_id',auth()->id())->get();
            foreach ($citas as $key => $value) {
                // $tratamientos=tratamiento::where('id',$value['tratamiento_id'])->get();
                $users=User::where('id',$value['peluquero_id'])->get();
                $data[$key]['id']=$value['id'];
                $data[$key]['fecha_cita']=$value['fecha_cita'];
                $data[$key]['hora_cita']=$value['hora_cita'];
                $data[$key]['precio']=$value['precio'];
                $data[$key]['tiempo']=$value['tiempo'];
                $data[$key]['tratamiento']=$value['tratamiento'];
                $data[$key]['peluquero']=$users[0]['name'];
                // $data[]['id']=$value['id'];
                // dd($tratamientos[0]['precio']);
            }
            usort($data, function($a, $b) {
                return strtotime($b['fecha_cita']) - strtotime($a['fecha_cita']);
            });

            // dd($data);
            return view('citas.index',compact('data'));
        }

        public function delete(Request $request){
            $pathInfo = $request->path();
            $parts = explode('/', $pathInfo);
            // dd($parts);
            $id = $parts[1];
            cita::where('id',$id)->delete();
            $mensaje = 'Cita eliminada correctamente';
            return redirect('/vercitas')->with(compact('mensaje'));

        }

        public function citasPeluqueroHOY()
        {

            if (isset($_REQUEST['fecha'])) {
                $fecha=$_REQUEST['fecha'];
            }else{
                $fecha=date('Y-m-d');
            }
            $data=[];
            $citas=cita::where('peluquero_id',auth()->id())->where('fecha_cita',$fecha)->get();
            foreach ($citas as $key => $value) {
                $tratamientos=tratamiento::where('id',$value['tratamiento_id'])->get();
                $users=User::where('id',$value['cliente_id'])->get();
                $data[$key]['id']=$value['id'];
                $data[$key]['asistencia']=$value['asistencia'];
                $data[$key]['fecha_cita']=$value['fecha_cita'];
                $data[$key]['hora_cita']=$value['hora_cita'];
                $data[$key]['precio']=$tratamientos[0]['precio'];
                $data[$key]['tiempo']=$tratamientos[0]['tiempo'];
                $data[$key]['tratamiento']=$tratamientos[0]['tratamiento'];
                $data[$key]['cliente']=$users[0]['name'];
                $data[$key]['descripcion']=$value['descripcion'];
                // $data[]['id']=$value['id'];
                // dd($tratamientos[0]['precio']);
            }
            usort($data, function($a, $b) {
                return strtotime($b['fecha_cita']) - strtotime($a['fecha_cita']);
            });
            if (!$_REQUEST) {
                return view('citas.citas_pelu',compact('data'),compact('fecha'));
            }else{
                $datos = [
                    'data' => $data,
                    'fecha' => $fecha
                ];
                return $datos;
            }
        }

        public function updateCita()
        {
            $id_cita = $_REQUEST['id_cita'];

            // Obtén la cita que deseas actualizar
            $cita = Cita::find($id_cita);

            // Verifica si se encontró la cita
            if ($cita) {
                // Actualiza los campos necesarios
                // $cita->fecha_cita = $_REQUEST->input('fecha_cita');
                // $cita->hora_cita = $_REQUEST->input('hora_cita');
                $cita->asistencia = 1;
                // Guarda los cambios en la base de datos
                $cita->save();

                // El registro se ha actualizado correctamente
                $mensaje = 'La cita ha sido actualizada correctamente.';
            } else {
                $mensaje = 'La cita no se encontró.';
            }

            // Redirige de vuelta a la página de citas con un mensaje
           return self::citasPeluqueroHOY();


        }


}


