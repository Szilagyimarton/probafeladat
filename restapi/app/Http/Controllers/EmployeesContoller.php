<?php

namespace App\Http\Controllers;

use App\Exceptions\DuplicateException;
use App\Models\Employee;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EmployeesContoller extends Controller
{
    public function loadXML()
    {
        try {

            DB::table('people')->truncate();

            $xmlFilePath = base_path('people.xml');

            $xml = simplexml_load_file($xmlFilePath);


            foreach ($xml->person as $person) {
                DB::insert('insert into people (name, email, dept, rank, phone, room) values (?, ?, ?, ?, ?, ?)', [$person->name, $person->email, $person->dept, $person->rank, $person->phone, $person->room]);
            }

            return response()->json(['message' => "XML is succesfully loaded to database!"]);
        } catch (Exception $e) {
            return response()->json(['message' => 'An unexpected error occured!', 'code' => '500'], 500);
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
                'phone' => 'required|regex:/^\+36 \(1\) 666-\d{4}$/',
                'room' => 'nullable'
            ]);

            Employee::create($formfields);
            return response()->json(['code' => '200', 'message' => $formfields['name'] . " is added to database!"], 200);
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
