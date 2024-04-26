<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes 
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');



Route::put('admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');



//Admin Routes => Categories
Route::resource('admin/categories', CategoryController::class)->names([
    'index' => 'admin.categories.index',
    'create' => 'admin.categories.create',
    'store' => 'admin.categories.store',
    'edit' => 'admin.categories.edit',
    'update' => 'admin.categories.update',
    'destroy' => 'admin.categories.destroy',
]);

// Route::resources([
//     '/admin/categories' => CategoryController::class,
//     '/management/menu' => MenuController::class,
//     '/management/table' => TableRoomController::class,
// ]);

// Route::resource('/admin/categories', CategoryController::class)->names([
//     'index' => 'admin.categories.index',
//     'create' => 'admin.categories.create',
//     'store' => 'admin.categories.store',
//     // Add more names here for the other resource routes
// ]);



//Admin Routes => Menus
Route::get('/admin/menus', function () {
    return view('admin.menus.index');
})->name('admin.menus.index');
Route::get('/admin/menus/create', function () {
    return view('admin.menus.create');
})->name('admin.menus.create');


//Admin Routes => Tables
Route::get('/admin/tables', function () {
    return view('admin.tables.index');
})->name('admin.tables.index');
Route::get('/admin/tables/create', function () {
    return view('admin.tables.create');
})->name('admin.tables.create');


//Admin Routes => Reservations
Route::get('/admin/reservations', function () {
    return view('admin.reservations.index');
})->name('admin.reservations.index');
Route::get('/admin/reservations/create', function () {
    return view('admin.reservations.create');
})->name('admin.reservations.create');


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

