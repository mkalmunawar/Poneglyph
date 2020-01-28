<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();

        return view('publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $publisher = new Publisher;
        $publisher->name = $request->name;
        $publisher->city = $request->city;
        $publisher->save();

        return redirect('publishers');
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
        $publisher = Publisher::find($id);

        return view('publisher.edit', compact('publisher'));
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
        $publisher = Publisher::find($id);
        $publisher->name = $request->name;
        $publisher->city = $request->city;
        $publisher->save();

        return redirect('publishers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publisher = Publisher::find($id);
        $publisher->delete();
        
        return redirect('publishers');
    }

    public function publisherData(){
        return DataTables::of(Publisher::all())
        ->addColumn('action', function($publisher){
            $csrf = csrf_token();
            return '
            <a href="/publishers/' . $publisher->id . '/edit" class="btn btn-sm btn-default">
                <i class="far fa-edit"></i>Ubah
            </a>
        
            <button type="button" class="btn btn-sm btn-default delete" id="' . $publisher->id . '">
                <i class="fas fa-trash"></i> Hapus
            </button>';

        })
        ->make(true);
    }
}
