<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PhotoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InfoController::class, 'home'])->name('home');
Route::get('/info/create', [InfoController::class, 'create'])->name('info.create');
Route::post('/info/create', [InfoController::class, 'store'])->name('info.store');
Route::get('/info/{hashid}/edit', [InfoController::class, 'edit'])->name('info.edit');
Route::post('/info/{hashid}/edit', [InfoController::class, 'update'])->name('info.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
