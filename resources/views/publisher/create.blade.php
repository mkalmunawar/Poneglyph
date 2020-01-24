@extends('adminlte::page')

@section('content_header')
    <h1 class="text-dark">Tambha Penerbit</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/publishers" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Penerbit</label>
                    <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nama Penerbit">
                </div>
                <div style="text-align : right">
                    <a class="btn btn-default" href="/publishers" role="button">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection