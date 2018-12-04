<?php

namespace YPPF\Extensons\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use YPPF\Extensons\App\Extension;


class ExtensionsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->get('q');
        $extensions = Extension::all();
        return view('extensions.index', compact('extensions', 'q'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('extensions.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:extensions',
            'secret' => 'required|string',
            'extension' => 'required|string|unique:extensions',
        ]);
        Extension::create($request->all());
        //flash($request->get('title') . ' extension saved.')->success()->important();
        return redirect()->route('extensions.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    private function show($id)
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
        $extension = Extension::findOrFail($id);
        return view('extensions.edit', compact('extension'));
    }
    /*
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $extension = Extension::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|string|max:255|unique:extensions,title,' . $extension->id,
            'description' => 'required|string'
        ]);
        $extension->update($request->all());
        //flash($request->get('title') . ' extension updated.')->success()->important();
        return redirect()->route('extensions.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Extension::find($id)->delete();
        //flash($request->get('title') . ' extension deleted.')->success()->important();
        return redirect()->route('extensions.index');
    }
}
