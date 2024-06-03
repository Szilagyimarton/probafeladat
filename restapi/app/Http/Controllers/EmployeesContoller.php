<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EmployeesContoller extends Controller
{
    public function index(){
        return view('index',[
            'employees' => Employee::all()
        ]);
    }

    public function show($email){
        try{
            $employee = Employee::findOrFail($email);
            return response()->json($employee);
        }
        catch(ModelNotFoundException $e){
           return response()->json(['message' => 'No email address found!', 'code' => '400'], 400);
        }
    }
    
    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $formfields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:people',
            'dept' => 'required',
            'rank' => 'required',
            'phone' => 'required|min:4|max:4'
        ]);
        $formfields['phone'] = "+36 (1) 666-" . $formfields['phone'];

        try{
            Employee::create($formfields);
            return redirect('/')->with('success', $formfields['name']. " is added to database!");
    
        }
        catch(\Exception $e){
           return response()->json(['code' => '400'], 400);
        }
       
    }
}   