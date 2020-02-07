@extends('adminlte::page')

@section('title', 'Katalog')

@section('content_header')
    <h1 class="text-dark">Catalog</h1>
@endsection

@section('content')
    @foreach ($books as $book)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <img src="{{url('uploads/books/'.$book->cover)}}" class="img-thumbnail" alt="">
                    </div>
                    <div class="col-9">
                        <h4>{{$book->name}}</h4>
                        <hr>
                        <h6>ISBN : {{$book->isbn}}</h6>
                        <h6>Penulis : {{$book->author}}</h6>
                        <h6>Edisi : {{$book->edition}}</h6>
                        <h6>Tanggal Terbit : {{$book->release_date}}</h6>
                        <h6>Nama Penerbit : {{$book->publisher->name}}</h6>
                        <span class="badge badge-primary">{{$book->category->name}}</span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection