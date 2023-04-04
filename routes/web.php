<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\ProfileController;
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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//le nostre rotte
Route::middleware('auth')->prefix('admin/doctors')->name('admin.doctors.')->group(function () {

    Route::get('/create', [DoctorController::class, 'create'])->name('create');
    Route::get('/edit/{user_id}', [DoctorController::class, 'edit'])->name('edit');
    Route::put('/update/{user_id}', [DoctorController::class, 'update'])->name('update');
    Route::post('/', [DoctorController::class, 'store'])->name('store');
});


require __DIR__ . '/auth.php';

Route::resource('admin/doctors', App\Http\Controllers\Admin\DoctorController::class, ['as' => 'admin']);