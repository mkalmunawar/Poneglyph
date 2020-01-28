@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="/books/{{$book->id}}" method="POST">
                @method('put')
                @csrf
                <div class="form-group">
                  <label for="isbn">ISBN</label>
                  <input type="text"
                    class="form-control" name="isbn" id="isbn" placeholder="ISBN" value="{{$book->isbn}}">
                </div>
                <div class="form-group">
                  <label for="name">Judul Buku</label>
                  <input type="text"
                    class="form-control" name="name" id="name" placeholder="Judul Buku" value="{{$book->name}}">
                </div>
                <div class="form-group">
                  <label for="edition">Edisi</label>
                  <input type="number"
                    class="form-control" name="edition" id="edition" placeholder="Edisi" value="{{$book->edition}}">
                </div>
                <div class="form-group">
                  <label for="release_date">Tanggal Terbit</label>
                  <input type="date"
                    class="form-control" name="release_date" id="release_date" placeholder="Tanggal Terbit" value="{{$book->release_date}}">
                </div>
                <div class="form-group">
                  <label for="author">Nama Pengarang</label>
                  <input type="text"
                    class="form-control" name="author" id="author" placeholder="Nama Pengarang" value="{{$book->author}}">
                </div>
                <div class="form-group">
                  <label for="publisher_id">Nama Penerbit</label>
                  <select class="form-control" name="publisher_id" id="publisher_id">
                      <option selected disabled>Pilih Nama Penerbit</option>
                      @foreach ($publishers as $publisher)
                          <option value="{{$publisher->id}}" @if ($book->publisher_id == $publisher->id) selected @endif>{{$publisher->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="category_id">Kategori</label>
                  <select class="form-control" name="category_id" id="category_id">
                    <option selected disabled>Pilih Nama Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if ($book->category_id == $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="cover">Cover</label>
                  <input type="file" class="form-control-file" name="cover" id="cover">
                </div>
                <div class="form-group">
                    <label for="qty">Jumlah Buku</label>
                    <input type="number"
                      class="form-control" name="qty" id="qty" placeholder="Jumlah" value="{{$book->qty}}">
                  </div>
                <div style="text-align : right">
                    <a class="btn btn-default" href="/books" role="button">Kembali</a>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
@endsection