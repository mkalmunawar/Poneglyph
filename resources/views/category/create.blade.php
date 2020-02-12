@extends('adminlte::page')

@section('content_header')
    <h1 class="text-dark">Tambah Kategori</h1>
@endsection

@section('content')
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            <li>
                @foreach ($errors->all() as $error)
                    {{$error}}
                @endforeach
            </li>
        </ul>
    </div>

    <script>
    $(".alert").alert();
    </script>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="/categories" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text"
                    class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nama Kategori">
                </div>
                <div style="text-align : right">
                    <a class="btn btn-default" href="/categories" role="button">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection