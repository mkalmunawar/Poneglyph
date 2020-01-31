<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employees = new Employee;
        $users = new User();

        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        
        $employees->nip = $request->nip;
        $employees->name = $request->name;
        $employees->address = $request->address;
        $employees->birth_date = $request->birth_date;
        $employees->user_id = $request->id;

        if ($employees->save() && $users->save()) {
            return redirect('employees');
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
        $employees = Employee::find($id);

        return view('employee.edit', compact('employees'));
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
        $employees = Employee::find($id);
        $users = User::find($employees->user_id);

        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        
        $employees->nip = $request->nip;
        $employees->name = $request->name;
        $employees->address = $request->address;
        $employees->birth_date = $request->birth_date;
        $employees->user_id = $request->id;

        if ($employees->save() && $users->save()) {
            return redirect('employees');
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
        $employees = Employee::find($id);
        $users = User::find($employees->user_id);

        if ($employees->delete() && $users->delete()) {
            return redirect('employees');
        }
    }

    public function employeeData(){
        return DataTables::of(Employee::all())
        ->addColumn('action', function($employee){
            $csrf = csrf_token();
            return '
            <a href="/employees/' . $employee->id . '/edit" class="btn btn-sm btn-default">
                <i class="far fa-edit"></i>Ubah
            </a>
        
            <button type="button" class="btn btn-sm btn-default delete" id="' . $employee->id . '">
                <i class="fas fa-trash"></i> Hapus
            </button>';
        })
        ->make(true);
    }
}
