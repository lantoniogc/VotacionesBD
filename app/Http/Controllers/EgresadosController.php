<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EgresadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo = 'Egresado';
        $egresados = \DB::Select("SELECT USR.cedula, USR.nombres, 
        USR.apellidos, USR.sexo, USR.email, 
        USR.email_alternativo,USR.direccion, 
        USR.telefono_principal, USR.telefono_alternativo,
        USR.password,
        EG.code_escuela, EG.foto, EG.ubicacion, 
        EG.nombre_referencia,EG.fecha_egreso, 
        EG.email_referencia, EG.telefono_referencia
        FROM egresados as EG, users as USR 
         WHERE EG.cedula = USR.cedula AND
               USR.tipo = 'Egresado'");

        /* SELECT * FROM egresados*/

        return view('egresados.main',
         compact('egresados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escuelas = \DB::table('escuelas')->get();
        return view('egresados.create', compact('escuelas'));
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
            'ubicacion' => 'required',
            'fecha_egreso' => 'required'
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

        \DB::table('egresados')->insert([
            'cedula' => $request->input('cedula'),
            'code_escuela' => $request->input('code_escuela'),
            'foto' => $request->input('foto'),
            'ubicacion' => $request->input('ubicacion'),
            'fecha_egreso' => $request->input('fecha_egreso')
        ]);

        return redirect('admin/egresados')->with('flash_message', 'Egresado added!');
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

        $egresados = \DB::table('egresados')->where(function ($query) use ($id) {
            $query->where('cedula', '=', $id);
        })->get();

        $escuelas = \DB::table('escuelas')->get();

        return view('egresados.edit', compact('usuarios','egresados','escuelas'));
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
            'ubicacion' => 'required',
            'fecha_egreso' => 'required'
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

        \DB::table('egresados')->where('cedula','=',$id)->update([
            'code_escuela' => $request->input('code_escuela'),
            'foto' => $request->input('foto'),
            'ubicacion' => $request->input('ubicacion'),
            'fecha_egreso' => $request->input('fecha_egreso')
        ]);

        return redirect('admin/egresados')->with('flash_message', 'Egresado edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('egresados')->where('cedula','=',$id)->delete();

        \DB::table('users')->where('cedula','=',$id)->delete();

        return redirect('admin/egresados')->with('flash_message', 'Egresados deleted!');
    }
}
