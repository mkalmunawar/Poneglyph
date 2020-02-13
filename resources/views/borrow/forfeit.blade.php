@extends('adminlte::page')

@section('title', 'Bayar Denda')

@section('content_header')
    <h1 class="text-dark">Pembayaran Denda</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Pegawai</h2>
                </div>
                <div class="card-body">
                    @foreach ($heads as $head)
                        <div class="form-group">
                        <label for="employee_code">NIP</label>
                        <input type="text" class="form-control" name="employee_code" id="employee_code" value="{{$head->employee->nip}}" readonly>
                        </div>
                        <div class="form-group">
                        <label for="employee_name">Nama Pegawai</label>
                        <input type="text" class="form-control" name="employee_name" id="employee_name" value="{{$head->employee->name}}" readonly>
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
                    @foreach ($heads as $head)
                        <div class="form-group">
                            <label for="student_code">NRP</label>
                            <input type="text" list="student_id_data" name="student_code" id="student_code" class="form-control" placeholder="Masukan NRP" value="{{$head->member->student_id}}" readonly>
                            <input type="hidden" name="student_id" class="student_id" id="student_id">
                        </div>
                        <div class="form-group">
                            <label for="student_name">Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="student_name" id="student_name" value="{{$head->member->name}}" readonly>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Buku</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="bg-dark">
                            <tr>
                                <th>NO</th>
                                <th>ISBN</th>
                                <th>Nama Buku</th>
                                <th>Edisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $detail)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$detail->book->isbn}}</td>
                                    <td>{{$detail->book->name}}</td>
                                    <td>{{$detail->book->edition}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" style="text-align: center"><b>TOTAL BUKU YANG DI PINJAM</b></td>
                                <td> @foreach($heads as $head) {{$head->total}} @endforeach</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: center"><b>DENDA PER BUKU</b></td>
                                <td>Rp. {{$forfeitPrice}}</td>
                            </tr>
                            <form action="/forfeit-payment" method="POST">
                                @csrf
                                <tr>
                                    <td colspan="3" style="text-align: center"><b>TOTAL DENDA</b></td>
                                    <td><input type="text" class="form-control" name="forfeit" id="forfeit" value="@foreach($heads as $head){{$head->total * $forfeitPrice}} @endforeach" readonly></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center"><b>BAYAR</b></td>
                                    <td><input type="number" class="form-control" name="disburse" id="disburse"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="text-align: center"><b>Kembalian</b></td>
                                    <td><input type="number" class="form-control" name="change" id="change" readonly></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="text-align: center"><button type="submit" class="btn btn-block btn-primary">Bayar</button></td>
                                </tr>
                                <input type="hidden" class="form-control" name="head_id" value="@foreach($heads as $head){{$head->id}} @endforeach">
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#disburse').change(function(){
                var disburse = $('#disburse').val();
                var forfeit =  $('#forfeit').val();
                var change = disburse - parseInt(forfeit);
                $('#change').val(change);
            });
        });
    </script>
@endsection