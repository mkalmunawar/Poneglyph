@extends('adminlte::page')

@section('title', 'Pinjam Buku')

@section('content_header')
    <h1 class="text-dark">Pinjam Buku</h1>
@endsection

@section('content')
    <form action="/borrows" method="POST">
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
                            <label for="employee_code">NIP</label>
                            <input type="text" class="form-control" name="employee_code" id="employee_code" value="{{$employee->nip}}" readonly>
                            </div>
                            <input type="hidden" name="employee_id" class="employee_id" id="employee_id" value="{{$employee->id}}">
                            <div class="form-group">
                            <label for="employee_name">Nama Pegawai</label>
                            <input type="text" class="form-control" name="employee_name" id="employee_name" value="{{$employee->name}}" readonly>
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
                          <label for="student_code">NRP</label>
                          <input type="text" list="student_id_data" name="student_code" id="student_code" class="form-control" placeholder="Masukan NRP">
                          <datalist id="student_id_data">
                            @foreach ($members as $member)
                                <option value="{{$member->student_id}}">{{$member->student_id}}</option>
                            @endforeach
                          </datalist>
                          <input type="hidden" name="student_id" class="student_id" id="student_id">
                        </div>
                        <div class="form-group">
                          <label for="student_name">Nama Mahasiswa</label>
                          <input type="text" class="form-control" name="student_name" id="student_name" readonly>
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
                    <div class="card-body books_form" id="books_form">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                  <label for="book_code">ISBN</label>
                                  <input type="text" list="book_isbn_code" class="form-control" name="book_code" id="book_code" placeholder="No ISBN">
                                  <datalist id="book_isbn_code">
                                    @foreach ($books as $book)
                                        <option value="{{$book->isbn}}">{{$book->isbn}}</option>
                                    @endforeach
                                  </datalist>
                                  <input type="hidden" name="book_id[]" class="book_id" id="book_id">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                  <label for="book">Buku</label>
                                  <input type="text" class="form-control" name="book" id="book" placeholder="Nama Buku" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                  <label for="edition">Edisi</label>
                                  <input type="text" class="form-control" name="edition" id="edition" placeholder="Edisi" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for=""></label>
                                  <button type="button" class="form-control btn btn-success mt-2 add_book" id="add_book"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" style="float: right;" id="submit">Pinjam</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            var members;
            var init_count = 1;
            $('#student_code').change(function(){
                $.get("/members-data-by-student/"+ $("#student_code").val(), function(data){
                    members = data;
                    $('#student_name').empty();
                    $('#student_id').empty();
                    members.forEach(member => {
                        $('#student_name').val(member.name);
                        $('#student_id').val(member.id);
                    });

                });
            });

            $('#book_code').change(function(){
                $.get("/books-data-by-isbn/"+ $("#book_code").val(), function(data){
                    members = data;
                    $('#book').empty();
                    $('#edition').empty();
                    $('#book_id').empty();
                    members.forEach(member => {
                        $('#book').val(member.name);
                        $('#edition').val(member.edition);
                        $('#book_id').val(member.id);
                    });

                });
            });

            $(".add_book").click( function(e){
                e.preventDefault();
                var max_fields = 10;
                if (init_count < max_fields) {
                    init_count++;
                    $('.books_form').append(
                        '<div class="row" id="'+init_count+'">'+
                            '<div class="col">'+
                                '<div class="form-group">'+
                                  '<label for="book_code">ISBN</label>'+
                                  '<input type="text" list="book_isbn_code" class="form-control book_code" name="book_code" id="book_code'+init_count+'" placeholder="No ISBN">'+
                                  '<datalist id="book_isbn_code">'+
                                    '@foreach ($books as $book)'+
                                        '<option value="{{$book->isbn}}">{{$member->isbn}}</option>'+
                                    '@endforeach'+
                                  '</datalist>'+
                                  '<input type="hidden" name="book_id[]" class="book_id" id="book_id'+init_count+'">'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-group">'+
                                  '<label for="book">Buku</label>'+
                                  '<input type="text" class="form-control book" name="book" id="book'+init_count+'" placeholder="Nama Buku" readonly>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-group">'+
                                  '<label for="edition">Edisi</label>'+
                                  '<input type="text" class="form-control edition" name="edition" id="edition'+init_count+'" placeholder="Edisi" readonly>'+
                                '</div>'+
                            '</div>'+
                            '<div class="col">'+
                                '<div class="form-group">'+
                                    '<label for=""></label>'+
                                  '<button type="button" class="form-control btn btn-danger mt-4 delete_book" id="delete_book"><i class="fa fa-minus"></i></button>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                }
            });

            $(".books_form").on("click", ".delete_book", function(e){
                e.preventDefault();
                $("#"+init_count).remove();
                init_count--;
            })
            
            $(".books_form").on("change", ".book_code", function(e){
                e.preventDefault();
                $.get("/books-data-by-isbn/"+ $("#book_code"+init_count).val(), function(data){
                    members = data;
                    $('#book'+init_count).empty();
                    $('#edition'+init_count).empty();
                    $('#book_id'+init_count).empty();
                    members.forEach(member => {
                        $('#book'+init_count).val(member.name);
                        $('#edition'+init_count).val(member.edition);
                        $('#book_id'+init_count).val(member.id);
                    });

                });
            })

            $('button#submit').on('click' , function(){
                var perilaku = document.getElementsByClassName('description')
                var alert = document.getElementsByClassName('alert')
                var perilaku_array = []
                for (let index = 0; index < perilaku.length; index++) {
                    var value = perilaku[index].value
                    if(value == ""){
                    perilaku_array.push(perilaku[index])
                    }else{
                    perilaku[index].classList.remove('is-invalid')
                    alert[index].classList.add('d-none')
                    }
                }
                if(perilaku_array != 0 ){
                    for (let index = 0; index < perilaku_array.length; index++) {
                    perilaku_array[index].classList.add('is-invalid')
                    alert_array[index].classList.remove('d-none')
                    }
                }else{
                    $('form#prilaku').submit()
                }

            });
        });
    </script>
@endsection