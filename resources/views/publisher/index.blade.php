@extends('adminlte::page')

@section('title', 'Tambah Penerbit')

@section('content_header')
    <h1 class="text-dark">Penerbit</h1>
@endsection

@section('content')
    
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary mb-3" href="/publishers/create" role="button">Tambah Penerbit</a>
            <table class="table table-striped" id="publishers-table">
                <thead class="bg-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Penerbit</th>
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
            var oTable = $('#publishers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url("publishers-data") }}'
                },
                columns: [
                {
                    "render": function ( data, type, full, meta ) {
                        return  meta.row+1;
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            });

        });
    </script>
@endsection
