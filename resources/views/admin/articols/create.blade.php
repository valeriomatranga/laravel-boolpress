@extends('layouts.admin')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1>Crea nuovo Articolo</h1>
    
    <form action="{{route('admin.articols.store')}}" method="post">
    @csrf
        <div class="form-group">
          <label for="name">Titolo</label>
          <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control" placeholder="Inserisci il titolo" aria-describedby="helpId">
          <small id="helpId" class="text-muted">max 255 caratteri</small>
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{old('description')}}</textarea>
        </div>

        <div class="form-group">
          <label for="date">Data</label>
          <input type="text" name="date" id="date" value="{{old('date')}}" class="form-control" placeholder="Inserisci la data" aria-describedby="helpId">
        </div>

        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
@endsection