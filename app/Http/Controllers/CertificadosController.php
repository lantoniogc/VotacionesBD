<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificadosController extends Controller
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
            \Session::flash('errorMsg','ERROR! Los certificados no pueden ser visualizados. No hay un periodo activo actualmente');
            return redirect('home');
        }

        if(\Auth::user()->tipo == 'Profesor')
        {
            $profesorGanador = \DB::table('profesores_candidatos')
            ->where('cedula','=',\Auth::user()->cedula)
            ->orderBy('votos','desc')
            ->take(1)
            ->count();

            if($profesorGanador == 0){
                \Session::flash('errorMsg','ERROR! No estás en el listado de ganadores');
                return redirect ('home');
            }
            else{
                $profesor = \DB::table('profesores')
                ->where('cedula','=',\Auth::user()->cedula)
                ->get();

                $escuela = \DB::table('escuelas')
                ->where('code_escuela','=',$profesor[0]->code_escuela)
                ->get();

                $cargoGanador = \DB::table('profesores_candidatos')
                ->where('cedula','=',\Auth::user()->cedula)
                ->orderBy('votos','desc')
                ->take(1)
                ->get();

                $cargo = \DB::table('cargos')
                ->where('code_cargo','=',$cargoGanador[0]->code_cargo)
                ->get();

                $pdf = \PDF::loadView('certificados', [
                    'profesor' => $profesor,
                    'escuela' => $escuela,
                    'periodoActivo' => $periodoActivo,
                    'cargo' => $cargo])
                    ->setPaper('A3', 'landscape')
                    ->setOptions(['orientation' => 'landscape', 'dpi' => 96, 'defaultFont' => 'arial']);
                    return $pdf->download('certificado '.\Auth::user()->nombres.' '.\Auth::user()->apellidos.'.pdf');
            }
        }

        if(\Auth::user()->tipo == 'Egresado')
        {
            $egresadoGanador = \DB::table('egresados_candidatos')
            ->where('cedula','=',\Auth::user()->cedula)
            ->orderBy('votos')
            ->take(1)
            ->count();

            if($egresadoGanador == 0){
                \Session::flash('errorMsg','ERROR! No estás en el listado de ganadores');
                return redirect ('home');
            }
            else{
                $egresado = \DB::table('egresados')
                ->where('cedula','=',\Auth::user()->cedula)
                ->get();

                $escuela = \DB::table('escuelas')
                ->where('code_escuela','=',$egresado[0]->code_escuela)
                ->get();

                $cargoGanador = \DB::table('egresados_candidatos')
                ->where('cedula','=',\Auth::user()->cedula)
                ->orderBy('votos')
                ->take(1)
                ->get();

                $cargo = \DB::table('cargos')
                ->where('code_cargo','=',$cargoGanador[0]->code_cargo)
                ->get();

                $pdf = \PDF::loadView('certificados', [
                    'egresado' => $egresado,
                    'escuela' => $escuela,
                    'periodoActivo' => $periodoActivo,
                    'cargo' => $cargo])
                    ->setPaper('A3', 'landscape')
                    ->setOptions(['orientation' => 'landscape', 'dpi' => 96, 'defaultFont' => 'arial']);
                    return $pdf->download('certificado '.\Auth::user()->nombres.' '.\Auth::user()->apellidos.'.pdf');
            }
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
        //
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
