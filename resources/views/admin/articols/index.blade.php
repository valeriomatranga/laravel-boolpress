@extends('layouts.admin')

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articols as $articol)
                    
                <tr>
                    <td scope="row">{{$articol->id}}</td>
                    <td>{{$articol->name}}</td>
                    <td>{{$articol->description}}</td>
                    <td>{{$articol->date}}</td>
                    <td>View | Edit | Delete</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection