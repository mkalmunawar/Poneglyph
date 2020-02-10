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
                          <label for="student_id">NRP</label>
                          <input type="text" list="student_id_data" name="student_id" id="student_id" class="form-control" placeholder="Masukan NRP">
                          <datalist id="student_id_data">
                            @foreach ($members as $member)
                                <option value="{{$member->student_id}}">{{$member->student_id}}</option>
                            @endforeach
                          </datalist>
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
                    <div class="card-body" id="books">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                  <label for="book_code">ISBN</label>
                                  <input type="text" list="book_isbn_code" class="form-control" name="book_code" id="book_code" placeholder="No ISBN">
                                  <datalist id="book_isbn_code">
                                    @foreach ($books as $book)
                                        <option value="{{$book->isbn}}">{{$member->isbn}}</option>
                                    @endforeach
                                  </datalist>
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
                                  <button type="button" class="form-control btn btn-success mt-2" id="add_book"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" style="float: right;" id="submit">Pinjam</button>
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
            var id =0;
            $('#student_id').change(function(){
                $.get("/members-data-by-student/"+ $("#student_id").val(), function(data){
                    members = data;
                    $('#student_name').empty();
                    members.forEach(member => {
                        $('#student_name').val(member.name);
                    });

                });
            });

            $('#book_code').change(function(){
                $.get("/books-data-by-isbn/"+ $("#book_code").val(), function(data){
                    members = data;
                    $('#book').empty();
                    $('#edition').empty();
                    members.forEach(member => {
                        $('#book').val(member.name);
                        $('#edition').val(member.edition);
                    });

                });
            });

            $('#add_book').on('click', function(){
                id++
                var row = $("<div/>", {
                    class: "row",
                    id: "div"+id
                });

                var col_isbn = $("<div/>", {
                    class: "col",
                });

                var col_book = $("<div/>", {
                    class: "col",
                });

                var col_edition = $("<div/>", {
                    class: "col",
                });

                var col_button = $("<div/>", {
                    class: "col",
                });

                var form_group_isbn = $("<div/>", {
                    class: "form-group",
                });

                var form_group_book = $("<div/>", {
                    class: "form-group",
                });
                
                var form_group_button = $("<div/>", {
                    class: "form-group",
                });

                var form_group_edition = $("<div/>", {
                    class: "form-group",
                });

                var label_isbn = $("<label/>", {
                    text: "ISBN",
                });

                var label_book = $("<label/>", {
                    text: "Buku",
                });

                var label_edition = $("<label/>", {
                    text: "Edisi",
                });
                
                var label_button = $("<label/>", {
                    text: "",
                    for:"",
                });

                var input_isbn = $("<input/>", {
                    type: "text",
                    class: "form-control",
                    list: "book_isbn_code",
                    id: "book_code"+id,
                    placeholder: "Masukan ISBN"
                });

                var input_book = $("<input/>", {
                    type: "text",
                    class: "form-control",
                    id: "book"+id,
                    placeholder: "Nama Buku",
                    disabled: true,
                });

                var input_edition = $("<input/>", {
                    type: "text",
                    class: "form-control",
                    id: "edition"+id,
                    placeholder: "Edisi",
                    disabled: true,
                });
                

                var button = $('<button/>' , {
                    class: 'form-control btn btn-danger mt-4',
                    id: id ,
                    type: "button"
                });

                button.append('<i class="fas fa-minus"> </i>');
                row.append(col_isbn, col_book, col_edition, col_button);
                col_isbn.append(form_group_isbn);
                col_book.append(form_group_book);
                col_edition.append(form_group_edition);
                col_button.append(form_group_button);
                form_group_isbn.append(label_isbn, input_isbn);
                form_group_book.append(label_book, input_book);
                form_group_edition.append(label_edition, input_edition);
                form_group_button.append(label_button, button);
                $('#books').append(row);
            });
            
            $(document).on('click' , 'button' , function(){
                var id = $(this).attr('id')
                document.getElementById('div'+id).remove()
            });

            $('#book_code'+id).change(function(){
                $.get("/books-data-by-isbn/"+ $("#book_code"+id).val(), function(data){
                    members = data;
                    $('#book'+id).empty();
                    $('#edition'+id).empty();
                    members.forEach(member => {
                        $('#book'+id).val(member.name);
                        $('#edition'+id).val(member.edition);
                    });

                });
            });

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