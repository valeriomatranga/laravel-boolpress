<?php

namespace App\Http\Controllers\API;

use App\Articol;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticolResource;
use Illuminate\Http\Request;

class ArticolController extends Controller
{
    public function index()
    {
        return ArticolResource::collection(Articol::with(['category', 'tags'])->paginate());
    }
}
