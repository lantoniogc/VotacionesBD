<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Procesos_ElectoralesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procesos_electorales = \DB::Table('procesos_electorales')->orderBy('periodo')->paginate(5);

        /* SELECT * FROM procesos_electorales*/

        return view('procesos_electorales.main',compact('procesos_electorales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('procesos_electorales.create');
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
            'periodo' => 'required',
            'status' => 'required',
            'fecha_votacion' => 'required',
            'fecha_inicio_postulacion' => 'required',
            'fecha_fin_postulacion' => 'required'
        ]);
        
        $requestData = $request->all();

        $validarStatus = \DB::table('procesos_electorales')->where('status','=','Activo')->count();

        if ($validarStatus == 1 && $request->input('status') == 'Activo'){
            $request->session()->flash('errorMsg','ERROR! Ya existe un proceso electoral activo');
            return redirect('admin/procesos_electorales/create');  
        }

        \DB::table('procesos_electorales')->insert([
            'periodo' => $request->input('periodo'),
            'status' => $request->input('status'),
            'fecha_votacion' => $request->input('fecha_votacion'),
            'fecha_inicio_postulacion' => $request->input('fecha_inicio_postulacion'),
            'fecha_fin_postulacion' => ($request->input('fecha_fin_postulacion'))
        ]);

        $profesores = \DB::table('profesores')->get();

        foreach ($profesores as $item){
            \DB::table('reg_electoral_profesores')->insert([
                'periodo' => $request->input('periodo'),
                'cedula' => $item->cedula,
            ]); 
        }

        $egresados = \DB::table('egresados')->get();

        foreach ($egresados as $item){
            \DB::table('reg_electoral_egresados')->insert([
                'periodo' => $request->input('periodo'),
                'cedula' => $item->cedula,
            ]); 
        }

        return redirect('admin/procesos_electorales')->with('flash_message', 'Proceso Electoral added!');
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
        $procesos_electorales = \DB::table('procesos_electorales')->where(function ($query) use ($id) {
            $query->where('periodo', '=', $id);
        })->get();

        return view('procesos_electorales.edit', compact('procesos_electorales'));
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
            'periodo' => 'required',
            'status' => 'required',
            'fecha_votacion' => 'required',
            'fecha_inicio_postulacion' => 'required',
            'fecha_fin_postulacion' => 'required'
        ]);
        
        $requestData = $request->all();

        $validarStatus = \DB::table('procesos_electorales')->where('status','=','Activo')->count();

        if ($validarStatus == 1 && $request->input('status') == 'Activo'){
            $request->session()->flash('errorMsg','ERROR! Ya existe un proceso electoral activo');
            return redirect('admin/procesos_electorales/'.$id.'/edit');  
        }

        \DB::table('procesos_electorales')->where('periodo','=',$id)->update([
            'periodo' => $request->input('periodo'),
            'status' => $request->input('status'),
            'fecha_votacion' => $request->input('fecha_votacion'),
            'fecha_inicio_postulacion' => $request->input('fecha_inicio_postulacion'),
            'fecha_fin_postulacion' => ($request->input('fecha_fin_postulacion'))
        ]);

        return redirect('admin/procesos_electorales')->with('flash_message', 'Proceso Electoral edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('procesos_electorales')->where('periodo','=',$id)->delete();

        return redirect('admin/procesos_electorales')->with('flash_message', 'Proceso Electoral deleted!');
    }
}
