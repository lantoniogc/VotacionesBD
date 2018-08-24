<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargosPorEscuelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cpe = \DB::table('cargos_por_escuelas')->orderby('periodo','desc')->paginate(10);
    
        /* SELECT * FROM cargos_por_escuela
        ORDER BY periodo DESC*/

        return view('cargos-por-escuelas.main', compact('cpe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $escuelas = \DB::table('escuelas')->get();
        $cargos = \DB::table('cargos')->get();
        $periodoActivo = \DB::table('procesos_electorales')->where('status','=','Activo')->get();
        $periodoActivoC = \DB::table('procesos_electorales')->where('status','=','Activo')->count();

        if($periodoActivoC == 0){
            $cpe = \DB::table('cargos_por_escuelas')->orderby('periodo','desc')->paginate(10);
            return view('cargos-por-escuelas.main', compact('cpe'));
        }
        return view('cargos-por-escuelas.create', compact('escuelas','cargos','periodoActivo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $requestData = $request->all();

        $periodoActivo = \DB::table('procesos_electorales')->where('status','=','Activo')->get();

        $canCreate = \DB::table('cargos_por_escuelas')->where('code_escuela','=',$request->input('code_escuela'))->where('code_cargo','=',$request->input('code_cargo'))->count();
        
        \DB::table('cargos_por_escuelas')->insert([
            'periodo' => $periodoActivo[0]->periodo,
            'code_escuela' => $request->input('code_escuela'),
            'code_cargo' => $request->input('code_cargo')
        ]);

        return redirect('admin/cargos-por-escuelas')->with('flash_message', 'Cargo del periodo added!');
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
        \DB::table('cargos_por_escuelas')->where('periodo','=',$id)->delete();

        return redirect('admin/cargos-por-escuelas')->with('flash_message', 'Cargos deleted!');
    }
}
