<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {

        // Intentar autenticar al usuario
        $result = $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
        // dd(auth()->user()->activo);
        // Si las credenciales son válidas pero el usuario no está activo, no permitir el inicio de sesión
        if ($result && !auth()->user()->activo) {
            $this->guard()->logout();
            throw ValidationException::withMessages([

                $this->username() => [trans('Usuario Desactivado.')],
            ]);
        }

        return $result;
    }


}
