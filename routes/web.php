<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

Route::middleware(['auth' , 'checkrole:1'])->group(function () {
    Route::get('/dashboard_admin', function () {
        return view('dashboard.admin');
    })->name('dashboard_admin');
});
Route::middleware(['auth' , 'checkrole:2'])->group(function () {
    Route::get('/dashboard_dev', function () {
        return view('dashboard.dev');
    })->name('dashboard_dev');
});

Route::middleware(['auth' , 'checkrole:3'])->group(function () {
    Route::get('/dashboard_cliente', function () {
        return view('dashboard.cliente');
    })->name('dashboard_cliente');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
