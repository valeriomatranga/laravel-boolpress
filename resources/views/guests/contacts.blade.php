@extends('layouts.app')


@section('content')
    <div class="container">
        @include('partials.error')
        @if(session('message'))
          <div class="alert alert-succes alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{session('message')}}</strong>
          </div>
        @endif
        <h1>Page Contact</h1>

        <form action="{{route('contacts.send')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="full_name">Full Name</label>
              <input value="{{old('full_name')}}" minlength="5" maxlength="255" required type="text" name="full_name" id="full_name" class="form-control" placeholder="Mario Rossi" aria-describedby="fullNameHelpe">
              <small id="fullNamehelpe class="text-muted">Inserisci nome e cognome</small>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input value="{{old('email')}}" type="email" class="form-control" required name="email" id="email" aria-describedby="emailHelpId" placeholder="">
              <small id="emailHelpId" class="form-text text-muted">Inserisci Email</small>
            </div>

            <div class="form-group">
              <label for="message">Messaggio</label>
              <textarea class="form-control" name="message" id="message" rows="5">{{old('message')}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Invia</button>
        </form>
    </div>
@endsection