@extends('adminlte::page')

@section('content_header')
    <h1 class="text-dark">Edit Penerbit</h1>
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
            <form action="/publishers/{{$publisher->id}}" method="POST">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="name">Nama Penerbit</label>
                    <input type="text"
                    class="form-control" name="name" id="name" placeholder="Nama Penerbit" value="{{$publisher->name}}">
                </div>
                <div class="form-group">
                    <label for="city">Asal Kota</label>
                    <input type="text"
                    class="form-control" name="city" id="city" placeholder="Asal Kota" value="{{$publisher->city}}">
                </div>
                <div style="text-align : right">
                    <a class="btn btn-default" href="/publishers" role="button">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection