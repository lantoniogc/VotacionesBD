<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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

    public function index($id)
    {
        return view('recuperar', compact('id'));
    }

    public function actualizar(Request $request, $id)
    {

        $this->validate($request, [
            'password' => 'required'
        ]);
        
        \DB::table('users')->where('cedula','=',$id)->update([
            'password' => bcrypt($request->input('password'))
        ]);

        $request->session()->flash('successMsg','Contraseña cambiada correctamente');
        return redirect('/');
    }
}
