<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodoActivo = \DB::table('procesos_electorales')->where('status','=','Activo')->get();
        $periodoActivoC = \DB::table('procesos_electorales')->where('status','=','Activo')->count();

        if($periodoActivoC == 0){
            \Session::flash('errorMsg','ERROR! No hay periodo activo actualmente, por lo tanto las votaciones están inactivas');
            return redirect('home');
        }

        if(\Auth::user()->tipo == 'Profesor')
        {
            $profesores = \DB::table('profesores')->where('cedula','=',\Auth::user()->cedula)->get();
            $cxe = \DB::table('cargos_por_escuelas')->where('code_escuela','=',$profesores[0]->code_escuela)->paginate(5);
            return view('votaciones.mainP', compact('cxe','periodoActivo'));
        }

        if(\Auth::user()->tipo == 'Egresado')
        {
            $egresados = \DB::table('egresados')->where('cedula','=',\Auth::user()->cedula)->get();
            $cxe = \DB::table('cargos_por_escuelas')->where('code_escuela','=',$egresados[0]->code_escuela)->paginate(5);
            return view('votaciones.mainE', compact('cxe','periodoActivo'));
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
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'cedula' => 'required',
        ]);

        $periodoActivo = \DB::table('procesos_electorales')->where('status','=','Activo')->get();

        if(\Auth::user()->tipo == 'Profesor')
        {
            $profesores = \DB::table('profesores')->where('cedula','=',$id)->get();
            \DB::table('profesores_vota_por')->insert([
                'cedula_p' => \Auth::user()->cedula,
                'periodo_re' => $periodoActivo[0]->periodo,
                'cedula_c' => $id,
                'periodo_c' => $periodoActivo[0]->periodo,
                'code_escuela' => $profesores[0]->code_escuela,
                'code_cargo' => $request->input('code_cargo')
            ]);
            
            $profCandidatos = \DB::table('profesores_candidatos')
            ->where('cedula','=',$id)
            ->where('periodo','=',$periodoActivo[0]->periodo)
            ->where('code_escuela','=',$profesores[0]->code_escuela)
            ->where('code_cargo','=',$request->input('code_cargo'))
            ->get();

            $votos = $profCandidatos[0]->votos;

            $votos = $votos + 1;

            \DB::table('profesores_candidatos')
            ->where('cedula','=',$id)
            ->where('periodo','=',$periodoActivo[0]->periodo)
            ->where('code_escuela','=',$profesores[0]->code_escuela)
            ->where('code_cargo','=',$request->input('code_cargo'))
            ->update(['votos' => $votos]);
        }

        if(\Auth::user()->tipo == 'Egresado')
        {
            $egresados = \DB::table('egresados')->where('cedula','=',$id)->get();
            \DB::table('egresados_vota_por')->insert([
                'cedula_e' => \Auth::user()->cedula,
                'periodo_re' => $periodoActivo[0]->periodo,
                'cedula_c' => $id,
                'periodo_c' => $periodoActivo[0]->periodo,
                'code_escuela' => $egresados[0]->code_escuela,
                'code_cargo' => $request->input('code_cargo')
            ]);

            $egreCandidatos = \DB::table('egresados_candidatos')
            ->where('cedula','=',$id)
            ->where('periodo','=',$periodoActivo[0]->periodo)
            ->where('code_escuela','=',$egresados[0]->code_escuela)
            ->where('code_cargo','=',$request->input('code_cargo'))
            ->get();

            $votos = $egreCandidatos[0]->votos;

            $votos = $votos + 1;

            \DB::table('egresados_candidatos')
            ->where('cedula','=',$id)
            ->where('periodo','=',$periodoActivo[0]->periodo)
            ->where('code_escuela','=',$egresados[0]->code_escuela)
            ->where('code_cargo','=',$request->input('code_cargo'))
            ->update(['votos' => $votos]);
        }


        $request->session()->flash('successMsg','SU VOTO HA SIDO PROCESADO CORRECTAMENTE'); 
        return redirect('votaciones');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::user()->tipo == 'Profesor')
        {
            $profesores = \DB::table('profesores')->where('cedula','=',\Auth::user()->cedula)->get();
            $candidatos = \DB::table('profesores_candidatos')
            ->where('code_escuela','=',$profesores[0]->code_escuela)
            ->where('code_cargo','=',$id)
            ->paginate(5);
            $cargo = \DB::table('cargos')->where('code_cargo','=',$id)->get();
            return view('votaciones.show', compact('candidatos','cargo')); 
        }

        if(\Auth::user()->tipo == 'Egresado')
        {
            $egresados = \DB::table('egresados')->where('cedula','=',\Auth::user()->cedula)->get();
            $candidatos = \DB::table('egresados_candidatos')
            ->where('code_escuela','=',$egresados[0]->code_escuela)
            ->where('code_cargo','=',$id)
            ->paginate(5);
            $cargo = \DB::table('cargos')->where('code_cargo','=',$id)->get();
            return view('votaciones.show', compact('candidatos','cargo')); 
        }
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
