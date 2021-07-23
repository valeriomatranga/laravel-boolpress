@extends('layouts.app')


@section('content')

    <div class="container">
        <img src="{{asset('storage/' . $articol->image)}}" alt="">
        <h1>{{$articol->name}}</h1>
        <p>{{$articol->description}}</p>
        <div>
            <span>{{$articol->date}}</span>
        </div>
        <a class="btn btn-secondary" href="{{route('articols.index')}}">Back</a>
    </div>
@endsection