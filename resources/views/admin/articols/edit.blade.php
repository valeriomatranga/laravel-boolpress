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
    
    <form action="{{route('admin.articols.update', $articol->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name">Titolo</label>
          <input type="text" name="name" value="{{$articol->name}}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Inserisci il titolo" aria-describedby="helpId">
          <small id="helpId" class="text-muted">max 255 caratteri</small>
        </div>

        <div class="form-group">
            <label for="image">Cambia immagine</label>
            <img src="{{asset('storage/' . $articol->image)}}" alt="">
            <input type="file" name="image" id="image">
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">{{$articol->description}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
@endsection