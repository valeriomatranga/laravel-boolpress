@extends('layouts.app')


@section('content')
    
    @foreach ($articols as $articol)
        <div class="container">
            <h2>{{$articol->name}}</h2>
            <p>{{$articol->description}}</p>
            <div>
                <span>{{$articol->date}}</span>
            </div>
        </div>
    @endforeach

@endsection