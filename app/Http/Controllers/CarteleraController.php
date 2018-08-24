<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarteleraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = \DB::table('cartelerainfo')->orderby('idart','desc')->paginate(10);

        /* SELECT * FROM cartelerainfo
        ORDER BY idart DESC*/

        return view('news.main', compact('news'));
    }

    public function indexPage(){
        $news = \DB::table('cartelerainfo')->orderby('idart','desc')->paginate(3);

        /*$news = \DB::select(
            '
            SELECT *
            FROM cartelerainfo
            ORDER BY idart DESC
            '
        );*/

        $lastnew = \DB::table('cartelerainfo')->orderby('idart','desc')->first();
        $carouselnews = \DB::table('cartelerainfo')->whereRaw('idart < (SELECT MAX(idart) FROM cartelerainfo)')->orderby('idart','desc')->take(2)->get();
        
        return view('home', compact('news','lastnew','carouselnews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
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
			'titulo' => 'required',
			'url_img' => 'required',
			'descripcion' => 'required',
			'body' => 'required'
        ]);
        
        $requestData = $request->all();

        \DB::table('cartelerainfo')->insert([
            'titulo' => $request->input('titulo'),
            'url_img' => $request->input('url_img'),
            'descripcion' => $request->input('descripcion'),
            'body' => $request->input('body'),
        ]);

        return redirect('admin/news')->with('flash_message', 'News added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = \DB::table('cartelerainfo')->where(function ($query) use ($id) {
            $query->where('idart', '=', $id);
        })->get();

        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = \DB::table('cartelerainfo')->where(function ($query) use ($id) {
            $query->where('idart', '=', $id);
        })->get();

        return view('news.edit', compact('news'));
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
			'titulo' => 'required',
			'url_img' => 'required',
			'descripcion' => 'required',
			'body' => 'required'
        ]);
        
        $requestData = $request->all();

        \DB::table('cartelerainfo')->where('idart','=',$id)->update([
            'titulo' => $request->input('titulo'),
            'url_img' => $request->input('url_img'),
            'descripcion' => $request->input('descripcion'),
            'body' => $request->input('body'),
        ]);

        return redirect('admin/news')->with('flash_message', 'News edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::table('cartelerainfo')->where('idart','=',$id)->delete();

        return redirect('admin/news')->with('flash_message', 'News deleted!');
    }
}
