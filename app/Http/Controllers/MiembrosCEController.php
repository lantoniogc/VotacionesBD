<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiembrosCEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create($id)
    {
        $id_ce = $id;
        return view('comision_electoral.miembros.create', compact('id_ce'));
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
            'fecha_ini' => 'required'
        ]);
        
        $requestData = $request->all();

        \DB::table('miembros_ce')->insert([
            'id_ce' => $id,
            'cedula' => $request->input('cedula'),
            'fecha_ini' => $request->input('fecha_ini'),
            'fecha_fin' => $request->input('fecha_fin'),
        ]);

        $users = \DB::table('users')->where('cedula','=',$request->input('cedula'))->get();
        $admin = 2;

        \DB::table('role_users')->insert([
            'user_id' => $users[0]->id,
            'role_id' => $admin
        ]);

        return redirect('admin/comision_electoral/'.$id.'/miembros')->with('flash_message', 'Miembro de Comisión electoral added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_ce = $id;
        $mce = \DB::table('miembros_ce')->where('id_ce','=',$id)->paginate(10);

        return view('comision_electoral.miembros.main', compact('mce', 'id_ce'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_ce, $id)
    {
        $mce = \DB::table('miembros_ce')->where(function ($query) use ($id) {
            $query->where('cedula', '=', $id);
        })->get();

        return view('comision_electoral.miembros.edit', compact('id_ce','mce'));
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
            'fecha_ini' => 'required'
        ]);
        
        $requestData = $request->all();

        \DB::table('miembros_ce')->where('cedula','=',$id)->update([
            'id_ce' => $request->input('id_ce'),
            'cedula' => $request->input('cedula'),
            'fecha_ini' => $request->input('fecha_ini'),
            'fecha_fin' => $request->input('fecha_fin'),
        ]);

        return redirect('admin/comision_electoral/'.$request->input('id_ce').'/miembros')->with('flash_message', 'Miembro de Comisión electoral edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('miembros_ce')->where('cedula','=',$id)->delete();

        $users = \DB::table('users')->where('cedula','=',$id)->get();
        $admin = 2;

        \DB::table('role_users')
        ->where('user_id','=',$users[0]->id)
        ->where('role_id','=',$admin)
        ->delete();

        return redirect()->back()->with('flash_message', 'Comisión electoral deleted!');
    }
}
