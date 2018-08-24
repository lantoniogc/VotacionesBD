<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $cargos = \DB::table('cargos')->orderby('code_cargo','desc')->paginate(10);
    
            /* SELECT * FROM cargos
            ORDER BY code_cargo DESC*/
    
            return view('cargos.main', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cargos.create');
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
			'nombre' => 'required'
        ]);
        
        $requestData = $request->all();

        \DB::table('cargos')->insert([
            'nombre' => $request->input('nombre'),
        ]);

        return redirect('admin/cargos')->with('flash_message', 'Cargo added!');
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
        $cargos = \DB::table('cargos')->where(function ($query) use ($id) {
            $query->where('code_cargo', '=', $id);
        })->get();

        return view('cargos.edit', compact('cargos'));
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
			'nombre' => 'required',
        ]);
        
        $requestData = $request->all();

        \DB::table('cargos')->where('code_cargo','=',$id)->update([
            'nombre' => $request->input('nombre'),
        ]);

        return redirect('admin/cargos')->with('flash_message', 'Cargo edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('cargos')->where('code_cargo','=',$id)->delete();

        return redirect('admin/cargos')->with('flash_message', 'Cargos deleted!');
    }
}
