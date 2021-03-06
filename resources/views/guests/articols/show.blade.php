@extends('layouts.app')


@section('content')

    <div class="container">
        <img src="{{asset('storage/' . $articol->image)}}" alt="">
        <h1>{{$articol->name}}</h1>
        <h4><strong>Category:</strong> <a href="{{route('categories.show', $articol->category->slug)}}">{{$articol->category ? $articol->category->name : 'Nessuna categoria'}}</a></h4>

        <div class="tags">
            Tags:
            @forelse($articol->tags as $tag)
                <span>{{$tag->name}}</span>
            @empty
                <span>No tags</span>
            @endforelse
        </div>

        <p>{{$articol->description}}</p>
        <a class="btn btn-secondary" href="{{route('articols.index')}}">Back</a>
    </div>
@endsection
