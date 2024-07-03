<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

//Route::get('/', HomeController::class)->name('home');
Route::get('/', Home::class)->name('home');

//Route::get('/', function () {
//    return view('dashboard');
//});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
