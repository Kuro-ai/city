<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderModel;
use App\Models\MenuModel;

class OrderController extends Controller
{
    // public function orderShoppingCart(Request $request)
    // {
    //     $menus = $request->input('menus');

    //     foreach ($menus as $menuId) {
    //         OrderModel::create([
    //             'name' => Auth::user()->name,
    //             'email' => Auth::user()->email,
    //             'phone_number' => Auth::user()->phone_number,
    //             'address' => Auth::user()->address,
    //             'menu_id' => $menuId,
    //             'reservation_id' => $request->input('reservation_id'),
    //         ]);
    //     }

    //     return redirect()->route('customer.index')->with('success', 'Order has been placed successfully!');
    // }

    public function orderShoppingCart(Request $request)
    {
        $menus = MenuModel::whereIn('id', $request->input('menus'))->get();

        return view('customer.order.shoppingcart', ['menus' => $menus]);
    }

    public function addToCart(Request $request)
    {
        $menuIds = $request->input('menus');

        $cartItems = MenuModel::whereIn('id', $menuIds)->get();

        // Store the cart items in the session so they can be accessed on the next request
        session(['cartItems' => $cartItems]);

        return redirect()->route('customer.order.shoppingcart');
    }

    public function showCart() {
        $cartItems = session('cartItems', []);
    
        $originalPrice = 0;
        $total = 0;
    
        foreach ($cartItems as $item) {
            $originalPrice += $item->price;
            $total += $item->price;
        }
    
        $orderSummary = (object) [
            'originalPrice' => $originalPrice,
            'total' => $total,
        ];
    
        return view('customer.order.shoppingcart', ['cartItems' => $cartItems, 'orderSummary' => $orderSummary]);
    }
}
