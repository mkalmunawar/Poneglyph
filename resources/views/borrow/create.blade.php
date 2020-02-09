@extends('adminlte::page')

@section('title', 'Pinjam Buku')

@section('content_header')
    <h1 class="text-dark">Pinjam Buku</h1>
@endsection

@section('content')
    <form action="" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Pegawai</h2>
                    </div>
                    <div class="card-body">
                        @foreach ($employees as $employee)
                            <div class="form-group">
                            <label for="employeeId">NIP</label>
                            <input type="text" class="form-control" name="employeeId" id="employeeId" value="{{$employee->nip}}" readonly>
                            </div>
                            <div class="form-group">
                            <label for="employeeName">Nama Pegawai</label>
                            <input type="text" class="form-control" name="employeeName" id="employeeName" value="{{$employee->name}}" readonly>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Mahasiwa</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <label for="studetId">NRP</label>
                          <input type="text" class="form-control" name="studetId" id="studetId" autocomplete="cc-number">
                        </div>
                        <div class="form-group">
                          <label for="studentName">Nama Mahasiswa</label>
                          <input type="text" class="form-control" name="studentName" id="studentName" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Buku</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                  <label for="isbn">ISBN</label>
                                  <input type="text" class="form-control" name="" id="" placeholder="ISBN">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                  <label for="book">Buku</label>
                                  <input type="text" class="form-control" name="" id="" placeholder="ISBN" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                  <label for="isbn">Edisi</label>
                                  <input type="text" class="form-control" name="" id="" placeholder="ISBN" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                  <label for="button"></label>
                                  <button type="button" class="form-control btn btn-success mt-2"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection