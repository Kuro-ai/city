<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReservationModel;
use App\Models\MenuModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
class AdminOrderController extends Controller
{
    public function index()
    {
        $orderList = DB::table('order_items')->join('orders', 'order_items.order_id', '=', 'orders.id')->select('order_items.*', 'orders.*')->orderBy('order_items.id', 'desc')->paginate(10); // Adjust the number based on your pagination needs
        return view('admin.orders.index', [
            'orderList' => $orderList,
          ]);
    }

    public function startOrder(Request $request)
    {
        $orderFood = $request->input('order_food');
        $reservationId = $request->input('reservation_id');

        $reservationId = $request->input('reservation_id');
        session()->put('reservation_id', $reservationId);

        if ($orderFood === 'yes') {
            return redirect()->route('admin.menus.index');
        } else {
            return redirect()->route('admin.index');
        }
    }

    public function showStartOrder()
    {
        $reservationId = session()->get('reservation_id');
        return view('admin.menus.index', ['reservation_id' => $reservationId]);
    }

    public function addToCart(Request $request)
    {
        $reservationId = $request->input('reservation_id');
        session()->put('reservation_id', $reservationId);
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

        return redirect()->route('admin.menus.index');
        
    }

    public function showCart()
    {
        $reservationId = session()->get('reservation_id');
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

        return view('admin.order.shoppingcart', ['cartItems' => $cartItems, 'orderSummary' => $orderSummary, 'reservation_id' => $reservationId]);
    }

    public function clearCart()
    {
        // Clear the cart items from the session
        session()->forget('cartItems');

        // Redirect back to the menu page
        return redirect()->route('admin.menus.index');
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
        return redirect()->route('admin.order.shoppingcart');
    }

    public function cartToCheckout(Request $request)
    {
        // Get the data from the request
        $reservation_id = $request->input('reservation_id');
        session()->put('reservation_id', $reservation_id);
        $cartItems = session()->get('cartItems', []);

        // Update the quantity of each item
        // foreach ($cartItems as &$item) {
        //     $item['quantity'] = $request->input("cartItems.{$item['id']}.quantity", 1);
        // }
        unset($item); // Unset reference to avoid side effects

        // Redirect to a success page
        session()->put('cartItems', $cartItems);
        return redirect()->route('admin.order.checkout');
    }

    public function checkout()
    {
        $reservation_id = session()->get('reservation_id');
        $reservation = ReservationModel::find($reservation_id);
        $cartItems = session()->get('cartItems', []);
        $total = session()->get('total');

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

        return view('admin.order.checkout', ['cartItems' => $cartItems, 'reservation' => $reservation, 'total' => $total, 'orderSummary' => $orderSummary]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request['user_id'] = \Illuminate\Support\Facades\Auth::id();
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'order_date' => 'required',
            'cartItems.*.id' => 'required',
            'cartItems.*.name' => 'required',
            'cartItems.*.price' => 'required|numeric',
            'cartItems.*.quantity' => 'required|integer',
            'cartItems.*.totalPrice' => 'required|numeric',
            'total' => 'required|numeric',
            'user_id' => 'required',
        ]);
    
        // Create a new order
        $order = new OrderModel();
        $order->first_name = $validated['first_name'];
        $order->last_name = $validated['last_name'];
        $order->phone = $validated['phone'];
        $order->email = $validated['email'];
        $order->address = $validated['address'];
        $order->total = $validated['total'];
        $order->order_date = $validated['order_date'];
        $order->reservation_id = $request->input('reservation_id');
        $order->user_id = $validated['user_id'];
        $order->save();
    
        // Save the cart items
        foreach ($validated['cartItems'] as $item) {
            $orderItem = new OrderItemModel();
            $orderItem->order_id = $order->id;
            $orderItem->menu_item_id = $item['id'];
            $orderItem->name = $item['name'];
            $orderItem->price = $item['price'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->total_price = $item['totalPrice'];
            $orderItem->save();
        }
    
        // Redirect to a success page
        session()->flash('status', 'Order is successfully added!');
        return redirect()->route('admin.index');
    }

    public function orderemail($id)
    {
        $order = DB::table('order_items')->join('orders', 'order_items.order_id', '=', 'orders.id')->select('order_items.*', 'orders.*')->where('order_items.id', $id)->first();

        $email = new OrderConfirmation($order);

        Mail::to($order->email)->send($email);

        DB::table('orders')
            ->where('id', $order->id)
            ->update(['email_sent' => true]);

        return redirect()->route('admin.orders.index')->with('status', 'Email is successfully sent!');
    }

    public function destroy(string $id)
    {
        $order = OrderModel::find($id);
        $orderItems = OrderItemModel::where('order_id', $id)->get();
        foreach ($orderItems as $orderItem) {
            $orderItem->delete();
        }
        $order->delete();
        session()->flash('deletestatus', 'Order is successfully deleted!');

        return redirect()->route('admin.orders.index');
    }
    
}
