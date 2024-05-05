<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Customer\CustomerCategoryController;
use App\Http\Controllers\Customer\CustomerMenuController;
use App\Http\Controllers\Customer\CustomerReservationController;
use App\Http\Controllers\Customer\SpecialsController;

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
    'restore' => 'admin.categories.restore',
]);
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
Route::resource('admin/tables', TableController::class)->names([
    'index' => 'admin.tables.index',
    'create' => 'admin.tables.create',
    'store' => 'admin.tables.store',
    'edit' => 'admin.tables.edit',
    'update' => 'admin.tables.update',
    'destroy' => 'admin.tables.destroy',
]);
//Admin Routes => Reservations
Route::resource('admin/reservations', ReservationController::class)->names([
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
// Customer Routes => Categories
Route::resource('customer/categories', CustomerCategoryController::class)->names([
    'index' => 'customer.categories.index',
    'show' => 'customer.categories.show',
    
]);


//Customer Routes => Menus
Route::resource('customer/menus', CustomerMenuController::class)->names([
    'index' => 'customer.menus.index',
]);
Route::resource('/customer', SpecialsController::class)->names([
    'index' => 'customer.index',
]);
Route::get('/thankyou', [SpecialsController::class, 'thankyou'])->name('thankyou');

//Customer Routes => Reservations
Route::get('customer/reservation/step-one', [CustomerReservationController::class, 'stepOne'])->name('customer.reservations.step.one');
Route::post('customer/reservation/step-one/store', [CustomerReservationController::class, 'storeStepOne'])->name('customer.reservations.store.step.one');
Route::get('customer/reservation/step-two', [CustomerReservationController::class, 'stepTwo'])->name('customer.reservations.step.two');
Route::post('customer/reservation/step-two/store', [CustomerReservationController::class, 'storeStepTwo'])->name('customer.reservations.store.step.two');
Route::resource('customer/reservations', CustomerReservationController::class)->names([
    'index' => 'customer.reservations.index',
]);


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


