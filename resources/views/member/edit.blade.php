@extends('adminlte::page')

@section('content_header')
    <h1 class="text-dark">Edit Anggota</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/members/{{$members->id}}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="name">Nama Anggota</label>
                    <input type="text"
                    class="form-control" name="name" id="name" placeholder="Nama Pegawai" value="{{$members->name}}">
                </div>
                <div class="form-group">
                    <label for="address">Alamat</label>
                    <input type="text"
                    class="form-control" name="address" id="address" placeholder="Alamat" value="{{$members->address}}">
                </div>
                <div class="form-group">
                    <label for="birth_date">Tanggal Lahir</label>
                    <input type="date"
                    class="form-control" name="birth_date" id="birth_date" value="{{$members->birth_date}}">
                </div>
                <div class="form-group">
                    <label for="image">Foto Kartu Tanda Mahasiswa</label>
                    <div class="row">
                        <div class="col-2">
                            <img src="{{url('uploads/members/'.$members->student_card)}}" id="image_preview" class="img-thumbnail" style="width: 100%; height: 70%; object-fit: cover;">
                        </div>
                        <div class="col-8">
                            <input type="file"
                            class="form-control-file" name="image" id="image" accept="image/*" onchange="loadFile(event)">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email"
                    class="form-control" name="email" id="email" placeholder="example@mail.com" value="{{$members->user->email}}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                    class="form-control" name="password" id="password" placeholder="password" value="{{$members->user->password}}">
                </div>
                <div style="text-align : right">
                    <a class="btn btn-default" href="/members" role="button">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var loadFile = function(event){
            var output = document.getElementById('image_preview');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection