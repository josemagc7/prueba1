<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;


class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes= User::where('rol' , 'cliente')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

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
                'rol'=>'cliente',
                'password'=>bcrypt($request->input('password')),
            ]
        );
        $mensaje='El/La cliente/a '.$request['name'].' ha sido registrado/a correctamente.';
        return redirect('/clientes')->with(compact('mensaje'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aux=User::where('rol' , 'cliente')->where('id' , $id)->get();
        $cliente=$aux[0];
        return view('clientes.edit',compact('cliente'));
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

        $aux=User::where('rol' , 'cliente')->where('id' , $id)->get();
        $user=$aux[0];
        $data=$request->only('name','email','dni','direccion','telefono');

        $pass=$request->input('password');
        if ($pass) {
           $data['password'] = bcrypt($pass);
        }



        $user->fill($data);
        $user->save();
        $mensaje='El/La cliente/a '.$request['name'].' ha sido actualizado/a correctamente.';
        return redirect('/clientes')->with(compact('mensaje'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $aux=User::where('rol' , 'cliente')->where('id' , $id)->get();
        $user=$aux[0];
        $inf=$user->name;
        $user->delete();

        $mensaje='El/La cliente/a '.$inf.' ha sido eliminado/a correctamente.';
        return redirect('/clientes')->with(compact('mensaje'));
    }
}
