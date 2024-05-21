<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Customer\CustomerMenuController;
use App\Http\Controllers\Customer\CustomerReservationController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Customer\ThankYouController;
use App\Http\Controllers\Admin\AdminThankYouController;
use App\Http\Controllers\Customer\HistoryListController;
use App\Http\Controllers\Customer\ContactController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ExpenseChart;
use App\Http\Controllers\Admin\IncomeChart;
use App\Http\Controllers\Admin\ProfitChart;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::group(['middleware' => 'useradmin'], function () {
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
    Route::get('/admin/menus/menuslist', [MenuController::class, 'menuslist'])->name('admin.menus.menuslist');
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

    Route::resource('admin/expenses', ExpenseController::class)->names([
        'index' => 'admin.expenses.index',
        'create' => 'admin.expenses.create',
        'show' => 'admin.expenses.show',
        'store' => 'admin.expenses.store',
        'edit' => 'admin.expenses.edit',
        'update' => 'admin.expenses.update',
        'destroy' => 'admin.expenses.destroy',
    ]);

    Route::resource('admin/chart', ExpenseChart::class)->names([
        'index' => 'admin.index',
    ]);

    Route::resource('admin/chart', IncomeChart::class)->names([
        'index' => 'admin.index',
    ]);
    Route::resource('admin/chart', ProfitChart::class)->names([
        'index' => 'admin.index',
    ]);

    Route::resource('admin/incomes', IncomeController::class)->names([
        'index' => 'admin.incomes.index',
        'create' => 'admin.incomes.create',
        'show' => 'admin.incomes.show',
        'store' => 'admin.incomes.store',
        'edit' => 'admin.incomes.edit',
        'update' => 'admin.incomes.update',
        'destroy' => 'admin.incomes.destroy',
    ]);

    Route::resource('admin/orders', AdminOrderController::class)->names([
        'index' => 'admin.orders.index',
        'destroy' => 'admin.orders.destroy',
    ]);
    Route::post('admin/orders/orderemail/{id}', [ReservationController::class, 'orderemail'])->name('admin.orders.orderemail');
    Route::post('admin/reservations/reservationemail/{id}', [ReservationController::class, 'reservationemail'])->name('admin.reservations.reservationemail');

    Route::resource('admin/user', UserController::class)->names([
        'index' => 'admin.user.index',
        'destroy' => 'admin.user.destroy',
    ]);

    //Admin Routes => Orders
    Route::get('/admin/order/shoppingcart', [AdminOrderController::class, 'showCart'])->name('admin.order.shoppingcart');
    Route::post('/admin/order/addToCart', [AdminOrderController::class, 'addToCart'])->name('admin.order.addToCart');
    Route::post('/admin/order/updateCart', [AdminOrderController::class, 'updateCart'])->name('admin.order.updateCart');
    Route::post('/admin/order/clearCart', [AdminOrderController::class, 'clearCart'])->name('admin.order.clearCart');
    Route::post('/admin/order/startOrder', [AdminOrderController::class, 'startOrder'])->name('admin.order.startOrder');
    Route::post('/admin/order/cartToCheckout', [AdminOrderController::class, 'cartToCheckout'])->name('admin.order.cartToCheckout');
    Route::get('/admin/order/checkout', [AdminOrderController::class, 'checkout'])->name('admin.order.checkout');
    Route::post('/admin/order/checkout', [AdminOrderController::class, 'store'])->name('admin.order.checkout.store');

    Route::get('/admin/thankyou', [AdminThankYouController::class, 'adminthankyou'])->name('admin.thankyou');
    Route::get('/admin/invoice', [IncomeController::class, 'store'])->name('admin.invoice');
    Route::get('/admin/incomes/{id}/download', [IncomeController::class, 'download'])->name('admin.incomes.download');
});

// Customer Routes
Route::group(['middleware' => 'usercustomer'], function () {
    Route::get('/customer', function () {
        return view('customer.index');
    })->name('customer.index');

    Route::resource('customer/menus', CustomerMenuController::class)->names([
        'index' => 'customer.menus.index',
    ]);

    Route::get('/thankyou', [ThankYouController::class, 'thankyou'])->name('thankyou');

    //Customer Routes => Reservations
    Route::get('customer/reservation/step-one', [CustomerReservationController::class, 'stepOne'])->name('customer.reservations.step.one');
    Route::post('customer/reservation/step-one/store', [CustomerReservationController::class, 'storeStepOne'])->name('customer.reservations.store.step.one');
    Route::get('customer/reservation/step-two', [CustomerReservationController::class, 'stepTwo'])->name('customer.reservations.step.two');
    Route::post('customer/reservation/step-two/store', [CustomerReservationController::class, 'storeStepTwo'])->name('customer.reservations.store.step.two');
    Route::resource('customer/reservations', CustomerReservationController::class)->names([
        'index' => 'customer.reservations.index',
    ]);

    //Customer Routes => Orders
    Route::get('/customer/order/shoppingcart', [OrderController::class, 'showCart'])->name('customer.order.shoppingcart');
    Route::post('/customer/order/addToCart', [OrderController::class, 'addToCart'])->name('customer.order.addToCart');
    Route::post('/customer/order/updateCart', [OrderController::class, 'updateCart'])->name('customer.order.updateCart');
    Route::post('/customer/order/clearCart', [OrderController::class, 'clearCart'])->name('customer.order.clearCart');
    Route::post('/customer/order/startOrder', [OrderController::class, 'startOrder'])->name('customer.order.startOrder');
    Route::post('/customer/order/cartToCheckout', [OrderController::class, 'cartToCheckout'])->name('customer.order.cartToCheckout');
    Route::get('/customer/order/checkout', [OrderController::class, 'checkout'])->name('customer.order.checkout');
    Route::post('/customer/order/checkout', [OrderController::class, 'store'])->name('customer.order.checkout.store');

    //Customer Routes => History
    Route::resource('customer/historylist', HistoryListController::class)->only([
        'index' => 'customer.historylist.index',
    ]);

    Route::get('/customer/historylist/index', [HistoryListController::class, 'index'])->name('customer.historylist.index');
    Route::get('/customer/customercontact', [ContactController::class, 'showForm'])->name('customer.customercontact');
    Route::get('/customer/terms', [ContactController::class, 'showTerms'])->name('customer.terms');
    Route::post('/customer/customercontact', [ContactController::class, 'sendEmail'])->name('customer.customercontact');
});
// Auth Checks
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.index');
        }
        return view('customer.index');
    })->name('dashboard');
});
