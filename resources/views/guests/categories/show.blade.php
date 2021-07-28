@extends('layouts.app')


@section('content')
    <div class="container">
        <h1>Articoli in: {{$category->name}}</h1>
        @forelse ($category->articols as $articol)
            <div class="card">
                <img class="card-img-top" src="{{asset('storage/' . $articol->image)}}" alt="{{$articol->name}}">
                <div class="card-body">
                    <h4 class="card-title">{{$articol->name}}</h4>
                    <p class="card-text">{{$articol->description}}</p>
                </div>
            </div>
            
        @empty
            <p>Nessun contenuto da mostrare</p>
        @endforelse
    </div>
@endsection