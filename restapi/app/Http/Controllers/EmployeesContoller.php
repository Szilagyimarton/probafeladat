<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmployeesContoller extends Controller
{
    public function loadXML(){
        try{
            include(app_path('loadxml.php'));
            return response()->json(['message' => "XML is succesfully loaded to database!" ]);
        }catch(Exception $e){
            return response()->json(['message' => $e->getMessage(), 'code' => '500']);
        }
    }

    public function show($email)
    {
        try {
            $employee = Employee::findOrFail($email);
            return response()->json($employee);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'No employee found with this email address!', 'code' => '400'], 400);
        } catch (Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred!', 'code' => '500'], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $formfields = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:people',
                'dept' => 'required',
                'rank' => 'required',
                'phone' => 'required|regex:/^\+36 \(1\) 666-\d{4}$/'
            ]);
            if($request['room']){
                $formfields['room'] = $request['room'];
            }else{
                $formfields['room'] = "Unknown";
            }
            Employee::create($formfields);
            return response($formfields);
        } catch (ValidationException $e) {
            return response()->json(['code' => '400', 'message' => $e->getMessage()], 400);
        } catch (Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred!', 'code' => '500'], 500);
        }
    }

    public function delete($email)
    {
        try {
            $employee = Employee::findOrFail($email);
            $employee->delete();
            return response()->json(['code' => '200', 'message' => $employee['name'] . " is deleted from database!"], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'No employee found with this email address!', 'code' => '400'], 400);
        } catch (Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred!', 'code' => '500'], 500);
        }
    }
}
