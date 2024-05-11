<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\tratamiento;
use App\Http\Controllers\Controller;

class TratamientoController extends Controller
{

	//Obliga a que toda ls rutas que resulva este controlador deba de tener un usuario autenticado
	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }

    //INYECTAMOS VISTA PRINCIPAL DE TRATAMIENTOS
    public function index()
    {
    	$tratamientos = tratamiento::all();
    	return view('tratamientos.index', compact('tratamientos'));
    }

    //INYECTAMOS VISTA DE CREAR NUEVO TRATAMIENTO
    public function create()
    {
    	return view('tratamientos.create');
    }
    //HACEMOS EL INSERT DEL NUEVO TRATAMIENTO
     public function add(Request $request)
    {
    	// dd($request->all()); esto imprime por pantalla
        $rules=
        [
            'tratamiento' => 'required|min:4',
            'precio' => 'required',
            'tiempo' => 'required',
            'descripcion' => 'required',
        ];

        $this->validate($request,$rules);

    	$tratamiento = new tratamiento();
    	$tratamiento->tratamiento = $request->input('tratamiento');
    	$tratamiento->precio = $request->input('precio');
        $tratamiento->tiempo = $request->input('tiempo');
    	$tratamiento->descripcion = $request->input('descripcion');
    	$tratamiento->save();

        $mensaje = 'Tratamiento '.$tratamiento->tratamiento.' registrado correctamente';

    	return redirect('/tratamientos')->with(compact('mensaje'));

    }

    //INYECTAMOS VISTA DE EDITAR TRATAMIENTO
    public function edit(tratamiento $tratamiento)
    {
        return view('tratamientos.edit',compact('tratamiento'));
    }

    //HACEMOS EL UPDATE DEL TRATAMIENTO
     public function update(Request $request, tratamiento $tratamiento)
    {
        // dd($request->all()); esto imprime por pantalla
        $rules=
        [
            'tratamiento' => 'required|min:4',
            'precio' => 'required',
            'tiempo' => 'required',
            'descripcion' => 'required',
        ];

        $this->validate($request,$rules);

        $tratamiento->tratamiento = $request->input('tratamiento');
        $tratamiento->precio = $request->input('precio');
        $tratamiento->tiempo = $request->input('tiempo');
        $tratamiento->descripcion = $request->input('descripcion');
        $tratamiento->save(); //update
        $mensaje = 'Tratamiento '.$tratamiento->tratamiento.' editado correctamente';
        return redirect('/tratamientos')->with(compact('mensaje'));
    }

    public function delete(tratamiento $tratamiento){
        // dd($tratamiento['activo']);

        if ($tratamiento['activo']) {
            $activo=0;
            $mensaje='El/La peluquero/a '.$tratamiento->name.' ha sido desactivado/a correctamente.';

        } else {
            $activo=1;
            $mensaje='El/La peluquero/a '.$tratamiento->name.' ha sido activado/a correctamente.';

        }
        $tratamiento->activo=$activo;
        $tratamiento->save();
        return redirect('/tratamientos')->with(compact('mensaje'));

    }



}
