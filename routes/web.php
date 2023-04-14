<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Api\Orders\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Message;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $id = Auth::id();
    $messages = Message::where('doctor_id', $id)->where('is_read', false)->get()->count();
    $reviews = Review::where('doctor_id', $id)->where('is_read', false)->get()->count();
    return view('dashboard', compact('messages', 'reviews'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//le nostre rotte
Route::middleware('auth')->prefix('admin/doctors')->name('admin.doctors.')->group(function () {

    Route::get('/edit/{user_id}', [DoctorController::class, 'edit'])->name('edit');
    Route::get('/create', [DoctorController::class, 'create'])->name('create');
    Route::put('/update/{user_id}', [DoctorController::class, 'update'])->name('update');
    Route::post('/', [DoctorController::class, 'store'])->name('store');
    //payment form routes
    Route::get('/sponsored', [DoctorController::class, 'sponsored'])->name('sponsored');
    Route::get('/sponsored/{id}', [DoctorController::class, 'paymentForm'])->name('paymentForm');
    Route::put('/{doctor}/updatepro', [DoctorController::class, 'updatepro'])->name('updatepro');
});
//Doctors Route

Route::resource('admin/doctors', App\Http\Controllers\Admin\DoctorController::class, ['as' => 'admin']);

//Message Route

Route::resource('admin/messages', App\Http\Controllers\Admin\MessageController::class, ['as' => 'admin']);
//SoftDelete Route
Route::get('/messages/trash', [MessageController::class, 'trash'])->name('admin.messages.trash');
Route::patch('/messages/{id}/restore', [MessageController::class, 'restore'])->name('admin.messages.restore');
Route::delete('/messages/{id}/delete', [MessageController::class, 'delete'])->name('admin.messages.delete');

Route::resource('admin/reviews', App\Http\Controllers\Admin\ReviewController::class, ['as' => 'admin']);
//SoftDelete Route
Route::get('/review/trash', [ReviewController::class, 'trash'])->name('admin.reviews.trash');
Route::patch('/review/{id}/restore', [ReviewController::class, 'restore'])->name('admin.reviews.restore');
Route::delete('/review/{id}/delete', [ReviewController::class, 'delete'])->name('admin.reviews.delete');


Route::post('admin/orders/make/payment', [DoctorController::class, 'makePayment'])->name('admin.orders.payment');


require __DIR__ . '/auth.php';
