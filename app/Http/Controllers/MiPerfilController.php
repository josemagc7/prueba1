<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
class MiPerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes= User::where('id' , auth()->id())->get();
        return view('miPerfil.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('miPerfil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function add(Request $request)
    // {
    //     $rules=[
    //         'name' => 'required|min:3',
    //         'email'=>'required|email',
    //         'dni'=>'nullable|min:9',
    //         'direccion'=>'nullable|min:4',
    //         'telefono'=>'nullable|min:9',
    //     ];
    //     $this->validate($request,$rules);

    //     User::create(
    //         $request->only('name','email','dni','direccion','telefono')
    //         +[
    //             'rol'=>'cliente',
    //             'password'=>bcrypt($request->input('password')),
    //         ]
    //     );
    //     $mensaje='El perfil '.$request['name'].' ha sido registrado/a correctamente.';
    //     return redirect('/clientes')->with(compact('mensaje'));
    // }

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
        $aux=User::where('id' , $id)->get();
        $cliente=$aux[0];
        return view('miPerfil.edit',compact('cliente'));
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

        $aux=User::where('id' , $id)->get();
        $user=$aux[0];
        $data=$request->only('name','email','dni','direccion','telefono');

        $pass=$request->input('password');
        if ($pass) {
           $data['password'] = bcrypt($pass);
        }



        $user->fill($data);
        $user->save();
        $mensaje='Tu perfil ha sido actualizado/a correctamente.';
        return redirect('/miPerfil')->with(compact('mensaje'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $user=User::where('id' , $id)->get()[0];
        $user->activo = 0;
        // $inf=$user->name;
        $user->save();
        return redirect(route('logout'));
    }

    public function ajustes()
    {
        // $clientes= User::where('id' , auth()->id())->get();
        return view('miPerfil.ajustes');
    }
}