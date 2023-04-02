<?php

use App\Http\Controllers\Api\DoctorController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//rotte dottori api 

Route::get('/doctors', [DoctorController::class, 'index']);

//show single doctor 

Route::get('/doctors/{doctor}', [DoctorController::class, 'show']);

//filter 
Route::get('/specializations/{id}/doctors', [DoctorController::class, 'specializationDoctorIndex']);
