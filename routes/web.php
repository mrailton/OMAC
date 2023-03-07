<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/members')->name('members.')->group(function () {
        Route::get('/', [MembersController::class, 'list'])->name('list');
        Route::post('/', [MembersController::class, 'store'])->name('store');
        Route::get('/create', [MembersController::class, 'create'])->name('create');
        Route::get('/{member:id}', [MembersController::class, 'show'])->name('show');
        Route::put('/{member:id}', [MembersController::class, 'update'])->name('update');
        Route::get('/{member:id}/edit', [MembersController::class, 'edit'])->name('edit');
        Route::delete('/{member:id}', [MembersController::class, 'delete'])->name('delete');
    });
});

require __DIR__.'/auth.php';
