<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class peluqueroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peluqueros= User::where('rol' , 'peluquero')->paginate(10);
        return view('peluqueros.index', compact('peluqueros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peluqueros.create');
    }
    // Uj0aUqQf
    /**
     * Store a newly created resource in storage.
     */
    public function add(Request $request)
    {
        $rules=[
            'name' => 'required|min:3',
            'email'=>'required|email',
            'dni'=>'nullable|min:9',
            'direccion'=>'nullable|min:4',
            'telefono'=>'nullable|min:9',
        ];
        $this->validate($request,$rules);

        User::create(
            $request->only('name','email','dni','direccion','telefono')
            +[
                'rol'=>'peluquero',
                'password'=>bcrypt($request->input('password')),
            ]
        );
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
        // $peluquero=User::where('rol' , 'peluquero')->findOrFail($id)->get();
        $aux=User::where('rol' , 'peluquero')->where('id' , $id)->get();
        $peluquero=$aux[0];
        return view('peluqueros.edit',compact('peluquero'));
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
        $mensaje='El/La peluquero/a '.$request['name'].' ha sido actualizado/a correctamente.';
        return redirect('/peluqueros')->with(compact('mensaje'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $aux=User::where('rol' , 'peluquero')->where('id' , $id)->get();
        $user=$aux[0];
        $inf=$user->name;
        $user->delete();

        $mensaje='El/La peluquero/a '.$inf.' ha sido eliminado/a correctamente.';
        return redirect('/peluqueros')->with(compact('mensaje'));

    }
}
