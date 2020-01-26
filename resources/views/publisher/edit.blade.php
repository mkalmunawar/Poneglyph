@extends('adminlte::page')

@section('content_header')
    <h1 class="text-dark">Edit Penerbit</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/publishers/{{$publisher->id}}" method="POST">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="name">Nama Penerbit</label>
                    <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nama Penerbit" value="{{$publisher->name}}">
                </div>
                <div style="text-align : right">
                    <a class="btn btn-default" href="/publishers" role="button">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection