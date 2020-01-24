@extends('adminlte::page')

@section('title', 'Tambah Penerbit')

@section('content_header')
    <h1 class="text-dark">Penerbit</h1>
@endsection

@section('content')
    
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary mb-3" href="/publishers/create" role="button">Tambah Penerbit</a>
            <table class="table table-striped">
                <thead class="bg-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Penerbit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publishers as $publisher)
                        <tr>
                            <td>{{$publisher->id}}</td>
                            <td>{{$publisher->name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection