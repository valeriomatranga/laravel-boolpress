@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">

            @foreach ($articols as $articol)
                <div class="card m-2 col-md-12">
                    <a href="{{route('articols.show', $articol->id)}}">
                        <img class=" p-3" src="{{asset('storage/' . $articol->image)}}" alt="">
                    </a>
                    <h2>{{$articol->name}}</h2>
                    <p>{{$articol->description}}</p>
                    <div>
                        <span>{{$articol->date}}</span>
                    </div>
                </div>
            @endforeach

        </div>
        {{$articols->links()}}
    </div>
    

@endsection