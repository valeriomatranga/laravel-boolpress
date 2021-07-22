@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">

            @foreach ($articols as $articol)
                <div class="col-md-4">
                    <a href="{{route('articols.show', $articol->id)}}">
                        <h2>{{$articol->name}}</h2>
                        <p>{{$articol->description}}</p>
                        <div>
                            <span>{{$articol->date}}</span>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
        {{$articols->links()}}
    </div>
    

@endsection