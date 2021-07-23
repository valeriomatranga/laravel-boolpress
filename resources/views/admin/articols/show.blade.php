@extends('layouts.admin')

@section('content')
    <img src="{{asset('storage/' . $articol->image)}}" alt="{{$articol->name}}">
    <h1>{{$articol->name}}</h1>
    <p>{{$articol->description}}</p>
    <div>
        <span>{{$articol->date}}</span>
    </div>

    <a href="{{route('admin.articols.index')}}"><i class="fas fa-arrow-left"></i>Back</a>
    <a href="{{route('admin.articols.edit', $articol->id)}}">Edit</a>
    
@endsection