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
        $extensions = Extension::all();
        return view('categories.index', compact('categories', 'q'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'title' => 'required|string|max:255|unique:categories',
            'description' => 'required|string|unique:categories',
        ]);
        Extension::create($request->all());
        //flash($request->get('title') . ' category saved.')->success()->important();
        return redirect()->route('categories.index');
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
        $category = Extension::findOrFail($id);
        return view('categories.edit', compact('category'));
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
        $category = Extension::findOrFail($id);
        $this->validate($request, [
            'title' => 'required|string|max:255|unique:categories,title,' . $category->id,
            'description' => 'required|string'
        ]);
        $category->update($request->all());
        //flash($request->get('title') . ' category updated.')->success()->important();
        return redirect()->route('categories.index');
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
        //flash($request->get('title') . ' category deleted.')->success()->important();
        return redirect()->route('categories.index');
    }
}
