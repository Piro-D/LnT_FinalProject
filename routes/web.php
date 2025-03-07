<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\User\UserInventoryController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\HomeController;
use App\Models\inventory;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware([UserMiddleware::class])
        ->prefix('user')
        ->name('user.')
        ->group(function(){
        Route::get('/dashboard', [UserInventoryController::class, 'dashboard'])-> name('dashboard');
        Route::post('/buy/{inventory}', [TransactionController::class, 'buy'])->name('buy');
        Route::get('/history', [TransactionController::class, 'history'])->name('history');
    });

    Route::middleware([AdminMiddleware::class])
        ->prefix('admin')
        ->name('admin.')
        ->group(function(){
            Route::get('/dashboard', [InventoryController::class, 'dashboard'])->name('dashboard');
            Route::get('/inventory/create', [InventoryController::class, 'create'])->name('create');
            Route::get('/inventory/{inventory}/edit', [InventoryController::class, 'edit'])->name('edit');

            Route::post('/inventory', [InventoryController::class, 'store'])->name('store');
            Route::put('/inventory/{inventory}', [InventoryController::class, 'update'])->name('update');
            Route::delete('/inventory/{inventory}', [InventoryController::class, 'delete'])->name('delete');
    });
});



require __DIR__.'/auth.php';
