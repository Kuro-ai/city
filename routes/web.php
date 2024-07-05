<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ExpenseChart;
use App\Http\Controllers\Admin\IncomeChart;
use App\Http\Controllers\Admin\ProfitChart;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminThankYouController;

use App\Http\Controllers\Manager\ManagerCategoryController;
use App\Http\Controllers\Manager\ManagerMenuController;
use App\Http\Controllers\Manager\ManagerTableController;
use App\Http\Controllers\Manager\ManagerReservationController;
use App\Http\Controllers\Manager\ManagerOrderController;
use App\Http\Controllers\Manager\ManagerThankYouController;
use App\Http\Controllers\Manager\ManagerExpenseController;
use App\Http\Controllers\Manager\ManagerExpenseChart;
use App\Http\Controllers\Manager\ManagerIncomeChart;
use App\Http\Controllers\Manager\ManagerProfitChart;
use App\Http\Controllers\Manager\ManagerIncomeController;
use App\Http\Controllers\Manager\ManagerUserController;

use App\Http\Controllers\Customer\CustomerMenuController;
use App\Http\Controllers\Customer\CustomerReservationController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ThankYouController;
use App\Http\Controllers\Customer\HistoryListController;
use App\Http\Controllers\Customer\ContactController;



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
    Route::post('admin/orders/orderemail/{id}', [AdminOrderController::class, 'orderemail'])->name('admin.orders.orderemail');
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
    Route::get('/admin/purchaseList', [ExpenseController::class, 'store'])->name('admin.purchaseList');
    Route::get('/admin/incomes/{id}/download', [IncomeController::class, 'download'])->name('admin.incomes.download');
    Route::get('/admin/expenses/{id}/download', [ExpenseController::class, 'download'])->name('admin.expenses.download');
});

Route::group(['middleware' => 'usermanager'], function () {
    Route::get('/manager', function () {
        return view('manager.index');
    })->name('manager.index');
    //manager Routes => Categories
    Route::resource('manager/categories', ManagerCategoryController::class)->names([
        'index' => 'manager.categories.index',
        'create' => 'manager.categories.create',
        'store' => 'manager.categories.store',
        'edit' => 'manager.categories.edit',
        'update' => 'manager.categories.update',
        'destroy' => 'manager.categories.destroy',
        'restore' => 'manager.categories.restore',
    ]);
    //manager Routes => Menus
    Route::resource('manager/menus', ManagerMenuController::class)->names([
        'index' => 'manager.menus.index',
        'create' => 'manager.menus.create',
        'store' => 'manager.menus.store',
        'edit' => 'manager.menus.edit',
        'update' => 'manager.menus.update',
        'destroy' => 'manager.menus.destroy',
    ]);
    Route::get('/manager/menus/menuslist', [ManagerMenuController::class, 'menuslist'])->name('manager.menus.menuslist');
    //manager Routes => Tables
    Route::resource('manager/tables', ManagerTableController::class)->names([
        'index' => 'manager.tables.index',
        'create' => 'manager.tables.create',
        'store' => 'manager.tables.store',
        'edit' => 'manager.tables.edit',
        'update' => 'manager.tables.update',
        'destroy' => 'manager.tables.destroy',
    ]);
    //manager Routes => Reservations
    Route::resource('manager/reservations', ManagerReservationController::class)->names([
        'index' => 'manager.reservations.index',
        'create' => 'manager.reservations.create',
        'store' => 'manager.reservations.store',
        'edit' => 'manager.reservations.edit',
        'update' => 'manager.reservations.update',
        'destroy' => 'manager.reservations.destroy',
    ]);

    Route::resource('manager/expenses', ManagerExpenseController::class)->names([
        'index' => 'manager.expenses.index',
        'create' => 'manager.expenses.create',
        'show' => 'manager.expenses.show',
        'store' => 'manager.expenses.store',
        'edit' => 'manager.expenses.edit',
        'update' => 'manager.expenses.update',
        'destroy' => 'manager.expenses.destroy',
    ]);

    Route::resource('manager/chart', ManagerExpenseChart::class)->names([
        'index' => 'manager.index',
    ]);

    Route::resource('manager/chart', ManagerIncomeChart::class)->names([
        'index' => 'manager.index',
    ]);
    Route::resource('manager/chart', ManagerProfitChart::class)->names([
        'index' => 'manager.index',
    ]);

    Route::resource('manager/incomes', ManagerIncomeController::class)->names([
        'index' => 'manager.incomes.index',
        'create' => 'manager.incomes.create',
        'show' => 'manager.incomes.show',
        'store' => 'manager.incomes.store',
        'edit' => 'manager.incomes.edit',
        'update' => 'manager.incomes.update',
        'destroy' => 'manager.incomes.destroy',
    ]);

    Route::resource('manager/orders', ManagerOrderController::class)->names([
        'index' => 'manager.orders.index',
        'destroy' => 'manager.orders.destroy',
    ]);
    Route::post('manager/orders/orderemail/{id}', [ManagerOrderController::class, 'orderemail'])->name('manager.orders.orderemail');
    Route::post('manager/reservations/reservationemail/{id}', [ManagerReservationController::class, 'reservationemail'])->name('manager.reservations.reservationemail');

    Route::resource('manager/user', ManagerUserController::class)->names([
        'index' => 'manager.user.index',
        'destroy' => 'manager.user.destroy',
    ]);

    //manager Routes => Orders
    Route::get('/manager/order/shoppingcart', [ManagerOrderController::class, 'showCart'])->name('manager.order.shoppingcart');
    Route::post('/manager/order/addToCart', [ManagerOrderController::class, 'addToCart'])->name('manager.order.addToCart');
    Route::post('/manager/order/updateCart', [ManagerOrderController::class, 'updateCart'])->name('manager.order.updateCart');
    Route::post('/manager/order/clearCart', [ManagerOrderController::class, 'clearCart'])->name('manager.order.clearCart');
    Route::post('/manager/order/startOrder', [ManagerOrderController::class, 'startOrder'])->name('manager.order.startOrder');
    Route::post('/manager/order/cartToCheckout', [ManagerOrderController::class, 'cartToCheckout'])->name('manager.order.cartToCheckout');
    Route::get('/manager/order/checkout', [ManagerOrderController::class, 'checkout'])->name('manager.order.checkout');
    Route::post('/manager/order/checkout', [ManagerOrderController::class, 'store'])->name('manager.order.checkout.store');

    Route::get('/manager/thankyou', [ManagerThankYouController::class, 'managerthankyou'])->name('manager.thankyou');
    Route::get('/manager/invoice', [ManagerIncomeController::class, 'store'])->name('manager.invoice');
    Route::get('/manager/purchaseList', [ManagerExpenseController::class, 'store'])->name('manager.purchaseList');
    Route::get('/manager/incomes/{id}/download', [ManagerIncomeController::class, 'download'])->name('manager.incomes.download');
    Route::get('/manager/expenses/{id}/download', [ManagerExpenseController::class, 'download'])->name('manager.expenses.download');
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
        switch (auth()->user()->userRole) {
            case 'admin':
                return redirect()->route('admin.index');
            case 'manager':
                return redirect()->route('manager.index');
            // case 'cashier':
            //     return redirect()->route('cashier.index');
            // case 'staff':
            //     return redirect()->route('staff.index');
            case 'customer':
                return view('customer.index');
            default:
                abort(403, 'Unauthorized access');
        }
    })->name('dashboard');
});
