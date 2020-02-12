@extends('adminlte::page')

@section('content_header')
    <h1 class="text-dark">Edit Pegawai</h1>
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
            <form action="/employees/{{$employees->id}}" method="POST">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text"
                    class="form-control" name="nip" id="nip" placeholder="Nomor Induk Pegawai" maxlength="9" value="{{$employees->nip}}">
                </div>
                <div class="form-group">
                    <label for="name">Nama Pegawai</label>
                    <input type="text"
                    class="form-control" name="name" id="name" placeholder="Nama Pegawai" value="{{$employees->name}}">
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text"
                    class="form-control" name="address" id="address" placeholder="Alamat" value="{{$employees->address}}">
                </div>
                <div class="form-group">
                    <label for="birth_date">Tanggal Lahir</label>
                    <input type="date"
                    class="form-control" name="birth_date" id="birth_date " value="{{$employees->birth_date}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email"
                    class="form-control" name="email" id="email" placeholder="example@mail.com" value="{{$employees->user->email}}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                    class="form-control" name="password" id="password" placeholder="password" value="{{$employees->user->password}}">
                </div>
                <div style="text-align : right">
                    <a class="btn btn-default" href="/employees" role="button">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection