<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tipo = 'Profesor';
        $profesores = \DB::Select("SELECT USR.cedula, USR.nombres, 
        USR.apellidos, USR.sexo, 
        USR.email, USR.email_alternativo,
        USR.direccion, USR.telefono_principal, USR.telefono_alternativo,
        USR.password,
        PRO.code_escuela, PRO.escalafon,
        PRO.fecha_ingreso
        FROM profesores as PRO, users as USR 
         WHERE PRO.cedula = USR.cedula AND
               USR.tipo = 'Profesor'");

        /* SELECT * FROM profesores*/

        return view('profesores.main', compact('profesores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escuelas = \DB::table('escuelas')->get();
        return view('profesores.create', compact('escuelas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'cedula' => 'required',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'sexo' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'direccion' => 'required',
            'telefono_principal' => 'required',
            'password' => 'required',
            'code_escuela' => 'required',
            'escalafon' => 'required',
            'fecha_ingreso' => 'required'
        ]);
        
        $requestData = $request->all();

        \DB::table('users')->insert([
            'cedula' => $request->input('cedula'),
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'sexo' => $request->input('sexo'),
            'tipo' => $request->input('tipo'),
            'email' => $request->input('email'),
            'direccion' => $request->input('direccion'),
            'telefono_principal' => $request->input('telefono_principal'),
            'password' => bcrypt($request->input('password'))
        ]);

        \DB::table('profesores')->insert([
            'cedula' => $request->input('cedula'),
            'code_escuela' => $request->input('code_escuela'),
            'escalafon' => $request->input('escalafon'),
            'fecha_ingreso' => $request->input('fecha_ingreso')
        ]);

        return redirect('admin/profesores')->with('flash_message', 'Profesor added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarios = \DB::table('users')->where(function ($query) use ($id) {
            $query->where('cedula', '=', $id);
        })->get();

        $profesores = \DB::table('profesores')->where(function ($query) use ($id) {
            $query->where('cedula', '=', $id);
        })->get();

        $escuelas = \DB::table('escuelas')->get();

        return view('profesores.edit', compact('usuarios','profesores','escuelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $this->validate($request, [
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'sexo' => 'required',
            'email' => 'required|string|email|max:255',
            'direccion' => 'required',
            'telefono_principal' => 'required',
            'password' => 'required',
            'code_escuela' => 'required',
            'escalafon' => 'required',
            'fecha_ingreso' => 'required'
        ]);
        
        $requestData = $request->all();

        \DB::table('users')->where('cedula','=',$id)->update([
            'nombres' => $request->input('nombres'),
            'apellidos' => $request->input('apellidos'),
            'sexo' => $request->input('sexo'),
            'email' => $request->input('email'),
            'direccion' => $request->input('direccion'),
            'telefono_principal' => $request->input('telefono_principal'),
            'password' => bcrypt($request->input('password'))
        ]);

        \DB::table('profesores')->where('cedula','=',$id)->update([
            'code_escuela' => $request->input('code_escuela'),
            'escalafon' => $request->input('escalafon'),
            'fecha_ingreso' => $request->input('fecha_ingreso')
        ]);

        return redirect('admin/profesores')->with('flash_message', 'Profesor edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('profesores')->where('cedula','=',$id)->delete();

        \DB::table('users')->where('cedula','=',$id)->delete();

        return redirect('admin/profesores')->with('flash_message', 'Profesores deleted!');

    }
}
