<?php

use App\Http\Controllers\Api\StudentController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('student', [StudentController::class, 'index']);
Route::post('student', [StudentController::class, 'create']);
Route::get('student/{id}', [StudentController::class, 'getStudentById']);
Route::put('student/{id}/edit', [StudentController::class, 'updateStudent']);
Route::delete('student/{id}', [StudentController::class, 'deleteStudent']);