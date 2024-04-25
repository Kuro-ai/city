<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if ( auth()->user()->is_admin) { 
            return redirect()->route('admin.index');
        }
        return view('customer.index');
    })->name('dashboard');
});
