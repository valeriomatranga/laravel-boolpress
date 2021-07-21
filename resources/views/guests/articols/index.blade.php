@extends('layouts.app')


@section('content')
    
    @foreach ($articols as $articol)
        <h2>{{$articol->name}}</h2>
    @endforeach

@endsection