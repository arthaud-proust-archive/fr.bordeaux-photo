<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\VoteController;


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
Route::get('maintenance', function () {
    return view('maintenance');
})->name('maintenance');


Route::middleware(['maintenanceCheck'])->group(function () {
    Route::get('/', [InfoController::class, 'home'])->name('home');

    
    Route::get('/info/create', [InfoController::class, 'create'])->name('info.create');
    Route::post('/info/create', [InfoController::class, 'store'])->name('info.store');
    Route::get('/info/{hashid}/edit', [InfoController::class, 'edit'])->name('info.edit');
    Route::post('/info/{hashid}/edit', [InfoController::class, 'update'])->name('info.update');
    Route::post('/info/{hashid}/delete', [InfoController::class, 'delete'])->name('info.delete');

    Route::get('/events', [EventController::class, 'index'])->name('event.index');
    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/create', [EventController::class, 'store'])->name('event.store');
    Route::get('/event/{hashid}', [EventController::class, 'show'])->name('event.show');
    Route::get('/event/{hashid}/photos', [EventController::class, 'photos'])->name('event.photos');
    Route::get('/event/{hashid}/results', [EventController::class, 'results'])->name('event.results');
    Route::get('/event/{hashid}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::post('/event/{hashid}/edit', [EventController::class, 'update'])->name('event.update');
    Route::post('/event/{hashid}/delete', [EventController::class, 'delete'])->name('event.delete');
    Route::get('/event/{hashid}/vote', [VoteController::class, 'show'])->name('vote.show');
    Route::post('/event/{hashid}/vote', [VoteController::class, 'note'])->name('vote.note');
    Route::get('/event/{hashid}/end', [VoteController::class, 'displayNotes'])->name('vote.display');

    Route::post('/photo/create', [PhotoController::class, 'store'])->name('photo.store');
    Route::get('/photo/create/{event_hashid?}', [PhotoController::class, 'create'])->name('photo.create');
    Route::get('/photo/{hashid}/edit', [PhotoController::class, 'edit'])->name('photo.edit');
    Route::post('/photo/{hashid}/edit', [PhotoController::class, 'update'])->name('photo.update');
    Route::post('/photo/{hashid}/delete', [PhotoController::class, 'delete'])->name('photo.delete');


    Route::get('/user/{hashid}', [UserController::class, 'show'])->name('user.show');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
