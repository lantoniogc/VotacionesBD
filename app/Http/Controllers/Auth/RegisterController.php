<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'cedula' =>  'required',
            'nombres' => 'required|string|max:30',
            'apellidos' => 'required|string|max:30',
            'sexo' => 'required',
            'tipo' => 'required|string|max:10',
            'email' => 'required|string|email|max:50|unique:users',
            'email_alternativo' => 'required|string|email|max:50',
            'direccion' => 'required|string|max:50',
            'telefono_principal' => 'required|string|max:11',
            'telefono_alternativo' => 'required|string|max:11',
            'password' => 'required|string|min:6|confirmed',
            'role' =>'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user=User::create([
            'cedula' => $data['cedula'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'sexo' => $data['sexo'],
            'tipo' => $data['tipo'],
            'email' => $data['email'],
            'email_alternativo' => $data['email_alternativo'],
            'direccion' => $data['direccion'],
            'telefono_principal' => $data['telefono_principal'],
            'telefono_alternativo' => $data['telefono_alternativo'],
            'password' => bcrypt($data['password']),
        ]);

        $user->roles()->attach($data['role']);

        return $user;
    }

    public function showRegistrationForm()
    {
        $roles=\App\Role::orderBy('name')->pluck('name','id');
        return view('auth.register',compact('roles'));
    }

    public function showRegistrationFormE()
    {
        $roles=\App\Role::orderBy('name')->pluck('name','id');
        return view('egresado.register',compact('roles'));
    }
}
