<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes 
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

//Admin Routes => Categories
Route::get('/admin/categories', function () {
    return view('admin.categories.index');
})->name('admin.categories.index');
Route::get('/admin/categories/create', function () {
    return view('admin.categories.create');
})->name('admin.categories.create');

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

