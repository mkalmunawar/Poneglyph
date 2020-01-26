@extends('adminlte::page')

@section('content_header')
    <h1 class="text-dark">Edit Kategori</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/categories/{{$category->id}}" method="POST">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nama Kategori" value="{{$category->name}}">
                </div>
                <div style="text-align : right">
                    <a class="btn btn-default" href="/categories" role="button">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection