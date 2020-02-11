@extends('adminlte::page')

@section('title', 'Data Peminjaman Buku')

@section('content_header')
    <h1 class="text-dark">Data Peminjam Buku</h1>
@endsection

@section('content')
    
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="borrows-table">
                <thead class="bg-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Anggota</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Total Buku</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
@stop

@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var oTable = $('#borrows-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url("borrows-data") }}'
                },
                columns: [
                {
                    "render": function ( data, type, full, meta ) {
                        return  meta.row+1;
                    }
                },
                {data: 'member.name', name: 'member.name'},
                {data: 'borrowing_date', name: 'borrowing_date'},
                {data: 'return_date', name: 'return_date'},
                {data: 'total', name: 'total'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            });

        });
    </script>
@endsection
