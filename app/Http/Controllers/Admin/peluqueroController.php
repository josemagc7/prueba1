<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use App\Models\tratamiento;
use App\Http\Controllers\Controller;

class peluqueroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peluqueros= User::where('rol' , 'peluquero')->orderBy('id', 'asc')->paginate(10);
        return view('peluqueros.index', compact('peluqueros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tratamientos = tratamiento::all();
        return view('peluqueros.create',compact('tratamientos'));
    }
    // Uj0aUqQf
    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        // dd($request->all());
        $rules=[
            'name' => 'required|min:3',
            'email'=>'required|email',
            'dni'=>'nullable|min:9',
            'direccion'=>'nullable|min:4',
            'telefono'=>'nullable|min:9'
        ];
        $this->validate($request,$rules);

        $user = User::create(
            $request->only('name','email','dni','direccion','telefono')
            +[
                'rol'=>'peluquero',
                'password'=>bcrypt($request->input('password')),
            ]
        );

        $user->tratamiento()->attach($request->input('tratamientos'));

        $mensaje='El/La peluquero/a '.$request['name'].' ha sido registrado/a correctamente.';
        return redirect('/peluqueros')->with(compact('mensaje'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tratamientos_peluquero=[];
        $sql=DB::select('select * from tratamiento_user where user_id = ?', [$id]);
        foreach ($sql as $key => $value) {
            $tratamientos_peluquero[$value->tratamiento_id]=$value;
        }

        $tratamientos = tratamiento::all();
        $aux=User::where('rol' , 'peluquero')->where('id' , $id)->get();
        $peluquero=$aux[0];
        return view('peluqueros.edit',compact('peluquero','tratamientos','tratamientos_peluquero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules=[
            'name' => 'required|min:3',
            'email'=>'required|email',
            'dni'=>'nullable|min:9',
            'direccion'=>'nullable|min:4',
            'telefono'=>'nullable|min:9',
        ];
        $this->validate($request,$rules);

        $aux=User::where('rol' , 'peluquero')->where('id' , $id)->get();
        $user=$aux[0];
        $data=$request->only('name','email','dni','direccion','telefono');

        $pass=$request->input('password');
        if ($pass) {
           $data['password'] = bcrypt($pass);
        }



        $user->fill($data);
        $user->save();

        $sql=DB::select('delete from tratamiento_user where user_id = ?', [$id]);
        $user->tratamiento()->attach($request->input('tratamientos'));


        $mensaje='El/La peluquero/a '.$request['name'].' ha sido actualizado/a correctamente.';
        return redirect('/peluqueros')->with(compact('mensaje'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {


        $user=User::where('rol' , 'peluquero')->where('id' , $id)->get()[0];

        if ($user['activo']) {
            $activo=0;
            $mensaje='El/La peluquero/a '.$user->name.' ha sido desactivado/a correctamente.';

        } else {
            $activo=1;
            $mensaje='El/La peluquero/a '.$user->name.' ha sido activado/a correctamente.';

        }

        $user->activo=$activo;
        $user->save();

        // $peluquero=User::where('rol' , 'peluquero')->where('id' , $id)->get()[0];
        // // $user=$aux[0];
        // $user->peluquero ;
        // $user->delete();

        // $mensaje='El/La peluquero/a '.$inf.' ha sido eliminado/a correctamente.';
        return redirect('/peluqueros')->with(compact('mensaje'));

    }
}
