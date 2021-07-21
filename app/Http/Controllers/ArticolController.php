<?php

namespace App\Http\Controllers;

use App\Articol;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articols = Articol::all();
        return view('guests.articols.index', compact('articols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articol  $articol
     * @return \Illuminate\Http\Response
     */
    public function show(Articol $articol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articol  $articol
     * @return \Illuminate\Http\Response
     */
    public function edit(Articol $articol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articol  $articol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articol $articol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articol  $articol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articol $articol)
    {
        //
    }
}
