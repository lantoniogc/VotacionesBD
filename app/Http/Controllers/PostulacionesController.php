<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostulacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodoActivoC = \DB::table('procesos_electorales')->where('status','=','Activo')->count();

        if($periodoActivoC == 0){
            \Session::flash('errorMsg','ERROR! No hay periodo activo actualmente, por lo tanto las postulaciones están inactivas');
            return redirect('home');
        }

        $miembrosCE = \DB::table('miembros_ce')->where('cedula','=',\Auth::user()->cedula)->count();

        if($miembrosCE == 1){
            \Session::flash('errorMsg','ERROR! Eres miembro de la comisión electoral. No tienes permitido postularte'); 
            return redirect('home');
        }

        if(\Auth::user()->tipo == 'Profesor')
        {
            $profesores = \DB::table('profesores')->where('cedula','=',\Auth::user()->cedula)->get();
            $escuelas = \DB::table('escuelas')->where('code_escuela','=',$profesores[0]->code_escuela)->get();
            $cxe = \DB::table('cargos_por_escuelas')->where('code_escuela','=',$profesores[0]->code_escuela)->get();
            return view('postulaciones.mainP', compact('profesores','escuelas','cxe'));
        }

        if(\Auth::user()->tipo == 'Egresado')
        {
            $egresados = \DB::table('egresados')->where('cedula','=',\Auth::user()->cedula)->get();
            $escuelas = \DB::table('escuelas')->where('code_escuela','=',$egresados[0]->code_escuela)->get();
            $cxe = \DB::table('cargos_por_escuelas')->where('code_escuela','=',$egresados[0]->code_escuela)->get(); 
            return view('postulaciones.mainE', compact('escuelas','cxe'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'code_cargo' => 'required',
        ]);

        $periodoActivo = \DB::table('procesos_electorales')->where('status','=','Activo')->get();

        if(\Auth::user()->tipo == 'Profesor')
        {
            $profesores = \DB::table('profesores')->where('cedula','=',\Auth::user()->cedula)->get();
            \DB::table('profesores_candidatos')->insert([
                'cedula' => \Auth::user()->cedula,
                'periodo' => $periodoActivo[0]->periodo,
                'code_escuela' => $profesores[0]->code_escuela,
                'code_cargo' => $request->input('code_cargo')
            ]);
        }

        if(\Auth::user()->tipo == 'Egresado')
        {
            $egresados = \DB::table('egresados')->where('cedula','=',\Auth::user()->cedula)->get();
            \DB::table('egresados_candidatos')->insert([
                'cedula' => \Auth::user()->cedula,
                'periodo' => $periodoActivo[0]->periodo,
                'code_escuela' => $egresados[0]->code_escuela,
                'code_cargo' => $request->input('code_cargo')
            ]);
        }

        $requestData = $request->all();

        $request->session()->flash('successMsg','FELICIDADES! Te has postulado al cargo correctamente'); 
        return redirect('postulaciones');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
