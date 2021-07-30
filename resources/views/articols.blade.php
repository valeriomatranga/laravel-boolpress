@extends('layouts.app')


@section('content')
    <div class="container">

        <h1>Vue Articols</h1>

        <div class="card text-left" v-for='articol in articols'>
            <img class="card-img-top" v-bind:src="'storage/' + articol.image" alt="">
            <div class="card-body">
                <h4 class="card-title">@{{articol.name}}</h4>
                <p class="card-text">@{{articol.description}}</p>
            </div>
        </div>
    </div>
@endsection
