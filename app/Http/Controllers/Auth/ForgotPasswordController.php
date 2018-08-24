<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('preguntas');
    }

    public function validarPreguntas(Request $request)
    {
        $this->validate($request, [
            'cedula' => 'required',
            'nombres' => 'required',
            'email' => 'required',
        ]);

        $valPregunta = \DB::table('users')
        ->where('cedula','=',$request->input('cedula'))
        ->where('nombres','=',$request->input('nombres'))
        ->where('email','=',$request->input('email'))
        ->count();

        if($valPregunta == 1)
        {
            return redirect('recuperar/'.$request->input('cedula'));
        }
        else
        {
            $request->session()->flash('errorMsg','ERROR! Alguna respuesta ha sido colocado de forma errónea');
            return view('preguntas');
        }
    }
}
