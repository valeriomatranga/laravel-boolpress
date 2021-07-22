<?php

namespace App\Http\Controllers\Admin;

use App\Articol;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class articolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articols = Articol::all()->sortByDesc('id');
        return view('admin.articols.index', compact('articols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articols.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ddd($request->all());

        $validatedData = $request->validate([
            'name' => 'required | max:255 | min:5',
            'description' => 'required',
            'date' => 'required'
        ]);
        Articol::create($validatedData);
        return redirect()->route('admin.articols.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Articol $articol)
    {
        return view('admin.articols.show', compact('articol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Articol $articol)
    {
        return view('admin.articols.edit', compact('articol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articol $articol)
    {
        $validatedData = $request->validate([
        'name' => 'required | max:255 | min:5',
        'description' => 'required',
        'date' => 'required'
        ]);
        $articol->update($validatedData);
        return redirect()->route('admin.articols.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articol $articol)
    {
        $articol->delete();
        return redirect()->route('admin.articols.index');
    }
}
