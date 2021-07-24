@extends('layouts.admin')

@section('content')

    @include('partials.error')
    <h1>Crea nuovo Articolo</h1>
    
    <form action="{{route('admin.articols.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
          <label for="name">Titolo</label>
          <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Inserisci il titolo" aria-describedby="helpId">
          <small id="helpId" class="text-muted">max 255 caratteri</small>
        </div>

{{--         <div class="form-group">
          <label for="image">Immagine</label>
          <input type="text" name="image" value="{{old('image')}}" id="image" class="form-control  @error('image') is-invalid @enderror" placeholder="https://" aria-describedby="helpId">
          <small id="helpId" class="text-muted">Inserisci immagine</small>
        </div>
 --}}
        <div class="form-group">
            <label for="image">Immagine</label>
            <input type="file" name="image" id="image">
        </div>
        @error('image')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror   
         
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">{{old('description')}}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
@endsection