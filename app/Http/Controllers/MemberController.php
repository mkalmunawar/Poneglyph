<?php

namespace App\Http\Controllers;

use App\Members;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Members::all();
        
        return view('member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $members = new Members;
        $users = new User;
        $validateData = $request->validate([
            "name" => "required",
            "email" => "required:email",
            "password" => "required",
            "student_id" => "required",
            "address" => "required",
            "birth_date" => "required",
        ]);

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->role = 'member';
        $users->save();
        
        $members->student_id = $request->student_id;
        $members->name = $request->name;
        $members->address = $request->address;
        $members->birth_date = $request->birth_date;
        $members->user_id = $users->id;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/members/' , $filename );
            $members->student_card = $filename;
        }

        if ($members->save()) {
            return redirect('members');
        }
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
        $members = Members::with('user')->find($id);
        
        return view('member.edit', compact('members'));
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
        $members = Members::find($id);
        $users = User::find($members->user_id);

        $validateData = $request->validate([
            "name" => "required",
            "email" => "required:email",
            "password" => "required",
            "student_id" => "required",
            "address" => "required",
            "birth_date" => "required",
        ]);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->role = 'member';
        $users->save();
        
        $members->student_id = $request->student_id;
        $members->name = $request->name;
        $members->address = $request->address;
        $members->birth_date = $request->birth_date;
        $members->user_id = $users->id;
        if($request->hasFile('image')){
            $image_path = 'uploads/members/'.$members->picture;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/members/' , $filename );
            $members->student_card = $filename;
        }else{
            $members->student_card = $members->student_card;
        }

        if ($members->save()) {
            return redirect('members');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $members = Members::find($id);
        $users = User::find($members->user_id);
        $image_path = 'uploads/members/'.$members->student_card;
        if(File::exists($image_path)){
            File::delete($image_path);
        }

        if ($members->delete() && $users->delete()) {
            return redirect('members');
        }
    }

    public function memberData(){
        return DataTables::of(Members::all())
        ->addColumn('action', function($member){
            $csrf = csrf_token();
            return '
            <a href="/members/' . $member->id . '/edit" class="btn btn-sm btn-default">
                <i class="far fa-edit"></i>Ubah
            </a>
        
            <button type="button" class="btn btn-sm btn-default delete" id="' . $member->id . '">
                <i class="fas fa-trash"></i> Hapus
            </button>';
        })
        ->make(true);
    }
}
