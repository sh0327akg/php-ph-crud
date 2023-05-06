<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;

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
    return view('top');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mypage', [ProfileController::class, 'mypage'])->name('mypage');
    Route::get('/user/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/ranking', [ProfileController::class, 'ranking'])->name('ranking');
    Route::post('/like/{post}', [LikeController::class, 'store'])->name('like');
    Route::delete('/unlike/{post}', [LikeController::class, 'destroy'])->name('unlike');
});

Route::resource('post', PostController::class);

require __DIR__.'/auth.php';
