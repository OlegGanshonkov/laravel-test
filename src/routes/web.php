<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Заменяем существующий маршрут dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->middleware('user.imitation')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/admin/user-imitation/{user}', [\App\Http\Controllers\Admin\UserImitationController::class, 'start'])
        ->name('admin.user-imitation');

    Route::post('/admin/stop-user-imitation', [\App\Http\Controllers\Admin\UserImitationController::class, 'stop'])
        ->name('admin.stop-user-imitation');
});


require __DIR__.'/auth.php';
