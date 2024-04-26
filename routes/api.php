<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'ems'
], function ($router) {
    //-----------------------------------Department Routes-----------------------------------//
    Route::get('/departments', [DepartmentController::class, 'index']);
    Route::post('/department', [DepartmentController::class, 'store']);
    Route::get('/departments/{department}', [DepartmentController::class, 'show']);
    Route::put('/departments/{department}', [DepartmentController::class, 'update']);
    Route::delete('/departments/{department}', [DepartmentController::class, 'destroy']);

//-----------------------------------Employee Routes-----------------------------------//
    Route::get('/employees', [EmployeeController::class, 'index']);
    Route::post('/employee', [EmployeeController::class, 'store']);
    Route::get('/employees/{employee}', [EmployeeController::class, 'show']);
    Route::put('/employees/{employee}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy']);

//-----------------------------------Project Routes-----------------------------------//
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/project', [ProjectController::class, 'store']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::put('/projects/{project}', [ProjectController::class, 'update']);
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

//-----------------------------------Note Routes-----------------------------------//
    Route::get('/notes', [NoteController::class, 'index']);
    Route::get('/notes/{note}', [NoteController::class, 'show']);
    Route::put('/notes/{note}', [NoteController::class, 'update']);
    Route::delete('/notes/{note}', [NoteController::class, 'destroy']);
    Route::post('/departments/{department}/notes', [NoteController::class, 'addNoteDepartment']);
    Route::post('/employees/{employee}/notes', [NoteController::class, 'addNoteEmployee']);
});
