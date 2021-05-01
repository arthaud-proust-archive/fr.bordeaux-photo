<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PageController;


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
Route::get('insta', function () {
    return view('insta');
})->name('insta');


Route::middleware(['maintenanceCheck'])->group(function () {

     




    Route::middleware(['role:jury'])->group(function () {
        Route::get('/event/{hashid}/vote/{photo?}', [VoteController::class, 'show'])->name('vote.show');
        Route::post('/event/{hashid}/vote', [VoteController::class, 'note'])->name('vote.note');
        Route::get('/event/{hashid}/end', [VoteController::class, 'displayNotes'])->name('vote.display');
        Route::get('/event/{hashid}/photos', [EventController::class, 'photos'])->name('event.photos');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/info/create', [InfoController::class, 'create'])->name('info.create');
        Route::post('/info/create', [InfoController::class, 'store'])->name('info.store');    
    
        Route::get('/info/{hashid}/edit', [InfoController::class, 'edit'])->name('info.edit');
        Route::post('/info/{hashid}/edit', [InfoController::class, 'update'])->name('info.update');
        Route::post('/info/{hashid}/delete', [InfoController::class, 'delete'])->name('info.delete');

        Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
        Route::post('/event/create', [EventController::class, 'store'])->name('event.store');
     
        Route::get('/event/{hashid}/edit', [EventController::class, 'edit'])->name('event.edit');
        Route::post('/event/{hashid}/edit', [EventController::class, 'update'])->name('event.update');
        Route::post('/event/{hashid}/delete', [EventController::class, 'delete'])->name('event.delete');

        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/{hashid}', [UserController::class, 'show'])->name('user.show');
        Route::get('/user/{hashid}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/{hashid}/edit', [UserController::class, 'update'])->name('user.update');
        Route::post('/user/{hashid}/delete', [UserController::class, 'delete'])->name('user.delete');

        Route::get('/pages', [PageController::class, 'index'])->name('page.index');
        Route::get('/page/create', [PageController::class, 'create'])->name('page.create');
        Route::post('/page/create', [PageController::class, 'store'])->name('page.store');
        Route::get('/page/{hashid}/edit', [PageController::class, 'edit'])->name('page.edit');
        Route::post('/page/{hashid}/edit', [PageController::class, 'update'])->name('page.update');
        Route::post('/page/{hashid}/delete', [PageController::class, 'delete'])->name('page.delete');
    });

    Route::middleware(['auth'])->group(function () {

        Route::get('/photo/create/{event_hashid?}', [PhotoController::class, 'create'])->name('photo.create');
        Route::post('/photo/create', [PhotoController::class, 'store'])->name('photo.store');
        Route::get('/photo/{hashid}/edit', [PhotoController::class, 'edit'])->name('photo.edit');
        Route::post('/photo/{hashid}/edit', [PhotoController::class, 'update'])->name('photo.update');
        Route::post('/photo/{hashid}/delete', [PhotoController::class, 'delete'])->name('photo.delete');
        
        Route::get('/profil/edit/', [ProfilController::class, 'edit'])->name('profil.edit');
        Route::post('/profil/edit', [ProfilController::class, 'update'])->name('profil.update');
        Route::post('/profil/delete', [ProfilController::class, 'delete'])->name('profil.delete');
        Route::get('/profil/{hashid?}', [ProfilController::class, 'show'])->name('profil.show');
        Route::get('/event/{hashid}/results', [EventController::class, 'results'])->name('event.results');
    });

    Route::get('/a-propos', [UserController::class, 'equipe'])->name('user.equipe');
    Route::get('/events', [EventController::class, 'index'])->name('event.index');
    Route::get('/events/old', [EventController::class, 'indexOlds'])->name('event.index.olds');
    Route::get('/event/{hashid}', [EventController::class, 'show'])->name('event.show');
    
    
});


require __DIR__.'/auth.php';
Route::get('/{url}', [PageController::class, 'show'])->name('page.show');
Route::get('/', [InfoController::class, 'home'])->name('home');
