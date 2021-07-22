@extends('layouts.admin')

@section('content')
    <div class="container_admin">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articols as $articol)
                    
                <tr>
                    <td scope="row">{{$articol->id}}</td>
                    <td>{{$articol->name}}</td>
                    <td>{{$articol->description}}</td>
                    <td>{{$articol->date}}</td>
                    <td><a href="">View</a><br>
                        <a href="">Edit</a><br>
                        <a href="">Delete</a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection