@extends('adminlte::page')

@section('title', 'Buku')

@section('content_header')
    <h1 class="text-dark">Buku</h1>
@endsection

@section('content')
    
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary mb-3" href="/books/create" role="button">Tambah Buku</a>
            <table class="table table-striped" id="books-table">
                <thead class="bg-dark">
                    <tr>
                        <th>No</th>
                        <th>ISBN</th>
                        <th>Judul Buku</th>
                        <th>Edisi</th>
                        <th>Tanggal Terbit</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Kategori</th>
                        <th>qty</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Hapus Buku</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                Data Buku Akan Terhapus Permanen
            </div>
            <div class="modal-footer">
            <form action="" method="POST" id="myForm">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya</button>
              </form>
            </div>
          </div>
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
            var oTable = $('#books-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ url("books-data") }}'
                },
                columns: [
                {
                    "render": function ( data, type, full, meta ) {
                        return  meta.row+1;
                    }
                },
                {data: 'isbn', name: 'isbn'},
                {data: 'name', name: 'name'},
                {data: 'edition', name: 'edition'},
                {data: 'release_date', name: 'release_date'},
                {data: 'author', name: 'author'},
                {data: 'publisher.name', name: 'publisher.name'},
                {data: 'category.name', name: 'category.name'},
                {data: 'qty', name: 'qty'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            });

            $('#books-table').DataTable().on('click' , 'button.delete' , function(){
              var id = $(this).attr('id');
              $('#myForm').attr('action' , '/books/'+id);
              $('#delete-modal').modal('show')
            });


        });
    </script>
@endsection
