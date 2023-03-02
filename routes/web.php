<?php

use App\Http\Controllers\MembersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/members')->name('members:')->group(function () {
        Route::get('/', [MembersController::class, 'list'])->name('list');
        Route::post('/', [MembersController::class, 'store'])->name('store');
        Route::get('/create', [MembersController::class, 'create'])->name('create');
        Route::get('/{member:id}', [MembersController::class, 'show'])->name('show');
        Route::put('/{member:id}', [MembersController::class, 'update'])->name('update');
        Route::get('/{member:id}/edit', [MembersController::class, 'edit'])->name('edit');
        Route::delete('/{member:id}', [MembersController::class, 'delete']);
    });
});

require __DIR__.'/auth.php';
