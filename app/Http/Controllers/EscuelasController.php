<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EscuelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $escuelas = \DB::table('escuelas')->orderby('code_escuela','desc')->paginate(10);

        /* SELECT * FROM escuelas
        ORDER BY idart DESC*/

        return view('escuelas.main', compact('escuelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('escuelas.create');
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

        \DB::table('escuelas')->insert([
            'nombre' => $request->input('nombre'),
        ]);

        return redirect('admin/escuelas')->with('flash_message', 'Escuela added!');
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
        $escuelas = \DB::table('escuelas')->where(function ($query) use ($id) {
            $query->where('code_escuela', '=', $id);
        })->get();

        return view('escuelas.edit', compact('escuelas'));
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

        \DB::table('escuelas')->where('code_escuela','=',$id)->update([
            'nombre' => $request->input('nombre'),
        ]);

        return redirect('admin/escuelas')->with('flash_message', 'Escuelas edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('escuelas')->where('code_escuela','=',$id)->delete();

        return redirect('admin/escuelas')->with('flash_message', 'Escuelas deleted!');
    }
}
