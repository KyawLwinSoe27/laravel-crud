<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index() {
       $student = Student::all();
        if($student->count() > 0) {
            $data = [
                'status_code' => 200,
                'data' => $student
               ];
               return response()->json($data,200);
        } else {
            $data = [
                'status_code' => 404,
                'data' => 'No Record Found'
               ];
               return response()->json($data,404);
        }
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'class' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10'
        ]);

        if($validator->fails()) {
            $data = [
                'status_code' => 422,
                'data' => $validator->messages()
            ];
            return response()->json($data,422);
        } else {
            $student = Student::create([
                'name' => $request->name,
                'class' => $request->class,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
            if($student) {
                $data = [
                    'status_code' => 201,
                    'data' => 'Student Created Successful'
                ];
                return response()->json($data,201);
            } else {
                $data = [
                    'status_code' => 500,
                    'data' => 'Something Went Wrnong!'
                ];
                return response()->json($data,201);
            }
        }
    }

    public function getStudentById(int $id) {
        $student = Student::find($id);

        if($student) {
            $data = [
                'status_code' => 200,
                'data' => $student
               ];
               return response()->json($data,200);
        } else {
            $data = [
                'status_code' => 404,
                'data' => 'No Record Found'
               ];
               return response()->json($data,404);
        }
    }

    public function updateStudent(Request $request, int $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'class' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10'
        ]);

        if($validator->fails()) {
            $data = [
                'status_code' => 422,
                'data' => $validator->messages()
            ];
            return response()->json($data,422);
        } else {
            $student = Student::find($id);

            $student -> update([
                'name' => $request->name,
                'class' => $request->class,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
            if($student) {
                $data = [
                    'status_code' => 201,
                    'data' => 'Student Updated Successful'
                ];
                return response()->json($data,201);
            } else {
                $data = [
                    'status_code' => 500,
                    'data' => 'Something Went Wrnong!'
                ];
                return response()->json($data,201);
            }
        }
    }

    public function deleteStudent(int $id) {
        $student = Student::find($id);

        if($student) {
            $student->delete();
            $data = [
                'status_code' => 203,
                'data' => 'delete successful'
               ];
               return response()->json($data,203);
        } else {
            $data = [
                'status_code' => 404,
                'data' => 'No Record Found'
               ];
               return response()->json($data,404);
        }
       
    }
}
