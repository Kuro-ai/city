<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderModel;
use App\Models\MenuModel;

class OrderController extends Controller
{
    public function index()
    {
        // // Fetch all orders for the authenticated customer
        // $orders = OrderModel::where('customer_id', Auth::id())->get();

        // // Return the 'customer.order.index' view, passing in the orders
        // return view('customer.order.index', ['orders' => $orders]);
        return view('customer.menus.index');
    }

    public function addToCart(Request $request)
    {
        $menuIds = $request->input('menus');
        $quantities = $request->input('quantities');

        // Retrieve items from the session if they exist, otherwise initialize an empty array
        $cartItems = session()->get('cartItems', []);

        foreach ($menuIds as $id) {
            if (isset($quantities[$id])) {
                // If the item already exists in the cart, update the quantity
                if (isset($cartItems[$id])) {
                    $cartItems[$id]['quantity'] += intval($quantities[$id]);
                } else {
                    // If the item does not exist in the cart, add it
                    $cartItems[$id] = [
                        'menuItem' => MenuModel::find($id),
                        'quantity' => intval($quantities[$id]),
                        'price' => floatval(MenuModel::find($id)->price),
                    ];
                }
            }
        }

        // Store the updated cart items in the session
        session()->put('cartItems', $cartItems);

        // Redirect back to the appropriate page based on whether there are items in the cart
        if (empty($cartItems)) {
            return redirect()->route('customer.menus.index');
        } else {
            return redirect()->route('customer.order.shoppingcart');
        }
    }

    public function showCart()
    {
        $cartItems = session()->get('cartItems', []);

        $total = 0;

        foreach ($cartItems as &$item) {
            $itemTotal = $item['price'] * $item['quantity'];
            $item['totalPrice'] = $itemTotal;
            $total += $itemTotal;
        }
        unset($item); // Unset reference to avoid side effects

        $orderSummary = (object) [
            'total' => $total,
        ];

        return view('customer.order.shoppingcart', ['cartItems' => $cartItems, 'orderSummary' => $orderSummary]);
    }

    public function clearCart()
    {
        // Clear the cart items from the session
        session()->forget('cartItems');

        // Redirect back to the menu page
        return redirect()->route('customer.menus.index');
    }

    public function updateCart(Request $request)
    {
        // Retrieve items from the session
        $cartItems = session()->get('cartItems', []);

        // Check if the 'remove' field is present in the request
        if ($request->has('remove')) {
            // Remove the item from the cart
            $id = $request->input('remove');
            unset($cartItems[$id]);
        } else {
            // Update the quantities of the cart items
            $quantities = $request->input('quantities');
            foreach ($quantities as $id => $quantity) {
                if (isset($cartItems[$id])) {
                    // Update the quantity of the cart item
                    $cartItems[$id]['quantity'] = intval($quantity);
                }
            }
        }

        // Store the updated cart items in the session
        session()->put('cartItems', $cartItems);

        // Redirect back to the shopping cart page
        return redirect()->route('customer.order.shoppingcart');
    }
}
