@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Welcome</h1>

        <a class="btn btn-primary" href="{{route('articols.index')}}">Visiona gli Articoli</a>
    </div>
@endsection