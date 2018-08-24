<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComisionElectoralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ce = \DB::table('comisiones_electorales')->paginate(10);

        return view('comision_electoral.main', compact('ce'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comision_electoral.create');
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

        \DB::table('comisiones_electorales')->insert([
            'nombre' => $request->input('nombre'),
        ]);

        return redirect('admin/comision_electoral')->with('flash_message', 'Comisión electoral added!');
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
        $ce = \DB::table('comisiones_electorales')->where(function ($query) use ($id) {
            $query->where('id_ce', '=', $id);
        })->get();

        return view('comision_electoral.edit', compact('ce'));
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

        \DB::table('comisiones_electorales')->where('id_ce','=',$id)->update([
            'nombre' => $request->input('nombre'),
        ]);

        return redirect('admin/comision_electoral')->with('flash_message', 'Comisión electoral edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('comisiones_electorales')->where('id_ce','=',$id)->delete();

        return redirect('admin/comision_electoral')->with('flash_message', 'Comisión electoral deleted!');
    }
}
