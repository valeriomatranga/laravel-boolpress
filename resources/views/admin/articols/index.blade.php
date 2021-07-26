@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between">
        <h1>All Articols</h1>
        <div>
            <a class="btn btn-primary" href="{{route('admin.articols.create')}}"><i class="fas fa-plus"> Crea Articolo</i></a>
        </div>
    </div>
    <div class="container_admin">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articols as $articol)
                    
                <tr>
                    <td scope="row">{{$articol->id}}</td>
                    <td>{{$articol->category->name}}</td>
                    <td><img style="width: 300px; height: 200px;" src="{{asset('storage/' . $articol->image)}}" alt=""></td>
                    <td>{{$articol->name}}</td>
                    <td>{{$articol->description}}</td>
                    <td>
                        <a href="{{route('admin.articols.show', $articol->id)}}" class="btn btn-primary"><i class="fas fa-eye"></i></a><br>
                        <a href="{{route('admin.articols.edit', $articol->id)}}" class="btn btn-secondary"><i class="fas fa-pencil-alt"></i></a><br>
                        <form action="{{route('admin.articols.destroy', $articol->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection