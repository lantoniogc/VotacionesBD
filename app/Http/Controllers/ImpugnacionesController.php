<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class ImpugnacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PC = \DB::table('profesores_candidatos')->paginate(4);
        $EC = \DB::table('egresados_candidatos')->paginate(4);
        return view('impugnaciones', compact('PC','EC'));
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
        $profCount = \DB::table('profesores_candidatos')->where('cedula','=',$id)->count();
        $egreCount = \DB::table('egresados_candidatos')->where('cedula','=',$id)->count();
        $motivo = 'Expulsado por la comision electoral';

        if($profCount == 1)
        {
            $profesor = \DB::table('profesores_candidatos')->where('cedula','=',$id)->get();
            \DB::table('profesores_impugnados')->insert([
                'cedula_p' => \Auth::user()->cedula,
                'fecha' => Carbon::today(),
                'motivo' => $motivo,
                'cedula_cp' => $profesor[0]->cedula,
                'periodo' => $profesor[0]->periodo,
                'code_escuela' => $profesor[0]->code_escuela,
                'code_cargo' => $profesor[0]->code_cargo
            ]);
            \DB::table('profesores_candidatos')->where('cedula','=',$id)->delete();
        }

        if($egreCount == 1)
        {
            $egresados = \DB::table('egresados_candidatos')->where('cedula','=',$id)->get();
            \DB::table('egresados_candidatos')->where('cedula','=',$id)->delete();
        }

        return redirect('admin/impugnaciones')->with('flash_message', 'Impugnado!');
    }
}
