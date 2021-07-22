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
        $articols = Articol::orderBy('id', 'DESC')->paginate(9);
        return view('guests.articols.index', compact('articols'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Articol  $articol
     * @return \Illuminate\Http\Response
     */
    public function show(Articol $articol)
    {
        return view('guests.articols.show', compact('articol'));
    }

}
