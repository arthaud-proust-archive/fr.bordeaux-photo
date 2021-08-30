<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


Route::post('/run', function () {
    if(request('token') == config('app.token')) {
        Artisan::call(request('command'));
        return 'done';
    }
    return 'no';
    // Artisan::call("view:cache");
});

Route::get('/optimize', function () {
    Artisan::call("optimize");
    return 'done';
});

Route::get('/optimize:clear', function () {
    Artisan::call("optimize:clear");
    return 'done';
});

