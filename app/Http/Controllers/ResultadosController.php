<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultadosController extends Controller
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
            \Session::flash('errorMsg','ERROR! Los resultados no pueden ser visualizados. No hay un periodo activo actualmente');
            return redirect('home');
        }

        $cxe = \DB::table('cargos_por_escuelas')->where('periodo','=',$periodoActivo[0]->periodo)->get();

        if(\Auth::user()->tipo == 'Profesor')
        {
            $pdf = \PDF::loadView('resultadosP', ['cxe' => $cxe,'periodoActivo' => $periodoActivo])
            ->setPaper('A3', 'landscape')
            ->setOptions(['orientation' => 'landscape', 'dpi' => 96, 'defaultFont' => 'arial', 'isRemoteEnabled' => true]);
            return $pdf->download('resultados.pdf');
        }

        if(\Auth::user()->tipo == 'Egresado')
        {
            $pdf = \PDF::loadView('resultadosE', ['cxe' => $cxe,'periodoActivo' => $periodoActivo])
            ->setPaper('A3', 'landscape')
            ->setOptions(['orientation' => 'landscape', 'dpi' => 96, 'defaultFont' => 'arial']);
            return $pdf->download('resultados.pdf');
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
