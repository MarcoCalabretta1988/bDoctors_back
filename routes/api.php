<?php

use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\Orders\OrderController;
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
// reegistration api
Route::post('/store', [DoctorController::class, 'store']);
//get reviev from front form api

Route::post('/review', [DoctorController::class, 'getREwiev']);
//vote

Route::post('/doctors/{doctor}', [DoctorController::class, 'getVote']);


//specializations

Route::get('/specializations', [DoctorController::class, 'specialization']);

//votes

Route::get('/votes', [DoctorController::class, 'votes']);

//filter 
Route::get('/specializations/{id}/doctors', [DoctorController::class, 'specializationDoctorIndex']);

Route::get('/votes/{id}/doctors', [DoctorController::class, 'voteDoctorIndex']);
//mails
Route::post('/messageMail', [DoctorController::class, 'messageMail']);

//PAYMENT
Route::get('orders/generate', [OrderController::class, 'generate'])->name('api.orders.generate');
Route::post('orders/make/payment', [OrderController::class, 'makePayment'])->name('api.orders.payment');
