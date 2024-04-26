<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes 
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

//Admin Routes => Categories
Route::resource('admin/categories', CategoryController::class)->names([
    'index' => 'admin.categories.index',
    'create' => 'admin.categories.create',
    'store' => 'admin.categories.store',
    'edit' => 'admin.categories.edit',
    'update' => 'admin.categories.update',
    'destroy' => 'admin.categories.destroy',
]);
Route::put('admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');

//Admin Routes => Menus
Route::resource('admin/menus', MenuController::class)->names([
    'index' => 'admin.menus.index',
    'create' => 'admin.menus.create',
    'store' => 'admin.menus.store',
    'edit' => 'admin.menus.edit',
    'update' => 'admin.menus.update',
    'destroy' => 'admin.menus.destroy',
]);

//Admin Routes => Tables
Route::resource('admin/tables', MenuController::class)->names([
    'index' => 'admin.tables.index',
    'create' => 'admin.tables.create',
    'store' => 'admin.tables.store',
    'edit' => 'admin.tables.edit',
    'update' => 'admin.tables.update',
    'destroy' => 'admin.tables.destroy',
]);

//Admin Routes => Reservations
Route::resource('admin/reservations', MenuController::class)->names([
    'index' => 'admin.reservations.index',
    'create' => 'admin.reservations.create',
    'store' => 'admin.reservations.store',
    'edit' => 'admin.reservations.edit',
    'update' => 'admin.reservations.update',
    'destroy' => 'admin.reservations.destroy',
]);

// Customer Routes
Route::get('/customer', function () {
    return view('customer.index');
})->name('customer.index');

// Route::get('/', function () {
//     if ( auth()->user()->is_admin) { 
//         return redirect()->route('admin.index');
//     }
//     return view('welcome');
// });
// Route::resources([
//     '/management/category' => CategoryController::class,
// ]);


// Auth Checks
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->is_admin) { 
            return redirect()->route('admin.index');
        }
        return view('customer.index');
    })->name('dashboard');

});

