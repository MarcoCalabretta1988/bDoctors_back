<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\ProfileController;
use App\Models\Message;
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
    $messages = Message::where('is_read', false)->get()->count();

    return view('dashboard', compact('messages'));
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
});


require __DIR__ . '/auth.php';

//Doctors Route

Route::resource('admin/doctors', App\Http\Controllers\Admin\DoctorController::class, ['as' => 'admin']);

//Message Route

Route::resource('admin/messages', App\Http\Controllers\Admin\MessageController::class, ['as' => 'admin']);
//SoftDelete Route
Route::get('/messages/trash', [MessageController::class, 'trash'])->name('admin.messages.trash');
Route::patch('/messages/{id}/restore', [MessageController::class, 'restore'])->name('admin.messages.restore');
Route::delete('/messages/{id}/delete', [MessageController::class, 'delete'])->name('admin.messages.delete');
