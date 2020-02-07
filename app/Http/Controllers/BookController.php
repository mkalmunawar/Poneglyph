<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('book.create', compact('publishers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book;
        $book->isbn = $request->isbn;
        $book->name = $request->name;
        $book->edition = $request->edition;
        $book->release_date = $request->release_date;
        $book->qty = $request->qty;
        $book->author = $request->author;
        $book->publisher_id = $request->publisher_id;
        $book->category_id = $request->category_id;
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->isbn . $request->name . $request->edition . $extension;
            $file->move('uploads/books', $filename);
            $book->cover = $filename;
        } else {
            $book->cover = '-';
        }

        $book->save();

        return redirect('books');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::with('publisher')->with('category')->find($id);
        $publishers = Publisher::all();
        $categories = Category::all();

        return view('book.edit', compact('book', 'publishers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->isbn = $request->isbn;
        $book->name = $request->name;
        $book->edition = $request->edition;
        $book->release_date = $request->release_date;
        $book->qty = $request->qty;
        $book->author = $request->author;
        $book->publisher_id = $request->publisher_id;
        $book->category_id = $request->category_id;
        $imageDelete = $book->image;
        $image_path = 'uploads/books/' . $imageDelete;
        if ($request->hasFile('cover')) {
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $file = $request->file('cover');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->isbn . $request->name . $request->edition . $extension;
            $file->move('uploads/books', $filename);
            $book->cover = $filename;
        } else {
            $book->cover =  $book->cover;
        }

        $book->save();

        return redirect('books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $imageDelete = $book->image;
        $image_path = 'uploads/books/' . $imageDelete;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $book->delete();

        return redirect('books');
    }

    public function catalog(){
        $books = Book::with('category', 'publisher')->get();

        return view('book.catalog', compact('books'));
    }

    public function bookData()
    {
        return DataTables::of(Book::with('publisher')->with('category')->get())
            ->addColumn('action', function ($book) {
                $csrf = csrf_token();
                return '
            <a href="/books/' . $book->id . '/edit" class="btn btn-sm btn-default">
                <i class="far fa-edit"></i>Ubah
            </a>
        
            <button type="button" class="btn btn-sm btn-default delete" id="' . $book->id . '">
                <i class="fas fa-trash"></i> Hapus
            </button>';
            })
            ->make(true);
    }
}
