<?php

namespace App\Http\Controllers;

use App\Book;
use App\DetailBorrowingBook;
use App\Employee;
use App\Forfeit;
use App\HeadBorrowingBook;
use App\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('borrow.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where('user_id', Auth::user()->id)->get();
        $members = Members::all();
        $books = Book::all();

        return view('borrow.create', compact('employees', 'members', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $head = new HeadBorrowingBook;
        $book = $request->book_id;
        
        $today = date("Y-m-d");
        $returnDate = date("Y-m-d", strtotime($today. ' + 7 days'));
        $head->borrowing_date = $today;
        $head->return_date = $returnDate;
        $head->member_id = $request->student_id;
        $head->employee_id = $request->employee_id;
        $head->total = count($book);
        $head->status = 'Dalam Peminjaman';
        $head->save();
        
        for ($index=0; $index < count($book); $index++) { 
            $detail = new DetailBorrowingBook;
            $detail->head_id = $head->id;
            $detail->book_id = $book[$index];
            $detail->save();
        }

        return redirect('borrows/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $heads = HeadBorrowingBook::with('member', 'employee')->where('id', $id)->get();
        $details = DetailBorrowingBook::with('book')->where('head_id', $id)->get();
        return view('borrow.show', compact('heads', 'details'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $heads = HeadBorrowingBook::with('member', 'employee')->where('id', $id)->get();
        $details = DetailBorrowingBook::with('book')->where('head_id', $id)->get();
        $forfeitPrice = 3000;
        
        return view('borrow.forfeit', compact('heads', 'details',  'forfeitPrice'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function memberData($id){
        return Members::where('student_id', $id)->get();
    }

    public function bookData($isbn){
        return Book::where('isbn', $isbn)->get();
    }

    public function borrowData(){
        return DataTables::of(HeadBorrowingBook::with('member')->get())
        ->addColumn('action', function($borrows){
                if(date_diff(date_create(date("Y-m-d")), date_create($borrows->return_date))->format("%R%a") < 0){
                    if ($borrows->status == 'Sudah Di Kembalikan Dengan Denda') {
                        return '
                        <a href="/borrows/' . $borrows->id .'" class="btn btn-sm btn-default">
                            <i class="far fa-eye"></i> Detail
                        </a>
                        <button type="button" class="btn btn-sm btn-danger disabled">
                            <i class="fa fa-coins"></i> Sudah Membayar Denda
                        </button>
                        ';
                    } else {
                        return '
                        <a href="/borrows/' . $borrows->id .'" class="btn btn-sm btn-default">
                            <i class="far fa-eye"></i> Detail
                        </a>
                        <a href="/borrows/' . $borrows->id .'/edit" class="btn btn-sm btn-danger">
                            <i class="fa fa-coins"></i> Bayar Denda
                        </a>
                        ';
                    }
                } else{
                    return '
                    <a href="/borrows/' . $borrows->id .'" class="btn btn-sm btn-default">
                        <i class="far fa-eye"></i>Detail
                    </a>';
                }
        })
        ->make(true);
    }

    public function forfeitPayment(request $request){
        $forfeits = new Forfeit;
        $head = HeadBorrowingBook::find($request->head_id);
        $forfeits->head_id = $request->head_id;
        $forfeits->total = $request->forfeit;
        $forfeits->disburse = $request->disburse;
        $forfeits->change = $request->change;
        $forfeits->save();
        $head->status = 'Sudah Di Kembalikan Dengan Denda';
        $head->save();

        return redirect('borrows');
    }
}
