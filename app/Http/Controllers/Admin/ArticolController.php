<?php

namespace App\Http\Controllers\Admin;

use App\Articol;
use App\Category;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.articols.index', compact('articols', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.articols.create', compact('categories', 'tags'));
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
            'image' => 'required | max:100',
            'category_id' => 'nullable | exists:categories,id',
            'tags' => 'nullable | exists:tags,id',
            'description' => 'required',
        ]);

        //ddd($validatedData);

        if($request->hasFile('image')){
            $file_path = Storage::put('articol_image', $validatedData['image']);
            $validatedData['image'] = $file_path;
        }

        $articol = Articol::create($validatedData);
        $articol->tags()->attach($request->tags);
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
        $tags = Tag::all();
        return view('admin.articols.show', compact('articol','tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Articol $articol)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.articols.edit', compact('articol','categories','tags'));
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
            'image' => 'required | max:100',
            'category_id' => 'nullable | exists:categories,id',
            'tags' => 'nullable | exists:tags,id',
            'description' => 'required',
        ]);

        if(array_key_exists('image', $validatedData)){
            $file_path = Storage::put('articol_image', $validatedData['image']);
            $validatedData['image'] = $file_path;
        }

        $articol = Articol::create($validatedData);
        $articol->tags()->attach($request->tags);
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
