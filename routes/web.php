<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Controllers\HajoController;
use App\Http\Controllers\KapcsolatController;
use App\Http\Controllers\AdminHajoController;

Route::view('/', 'fooldal')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::view('/kapcsolat', 'kapcsolat')->name('kapcsolat');

Route::post('/kapcsolat', [KapcsolatController::class, 'store'])
    ->name('kapcsolat.store');

Route::get('/uzenetek', [KapcsolatController::class, 'index'])
    ->middleware('auth')
    ->name('uzenetek');


Route::middleware(['auth', EnsureUserIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminHajoController::class, 'index'])
            ->name('hajok.index');

        Route::resource('hajok', AdminHajoController::class)
            ->parameters(['hajok' => 'hajo'])
            ->except(['index', 'show']);
    });

Route::get('/adatbazis', [HajoController::class, 'index'])
    ->name('adatbazis');

Route::get('/diagram', [HajoController::class, 'diagram'])
    ->name('diagram');


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';


