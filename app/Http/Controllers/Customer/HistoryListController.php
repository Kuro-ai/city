<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\ReservationModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HistoryListController extends Controller
{
    public function index()
    {
        $reservationList = $this->reservationlist();
        $orderList = $this->orderlist();

        return view('customer.historylist.index', ['reservationList' => $reservationList, 'orderList' => $orderList]);
    }

    public function reservationlist()
    {
        $user = auth()->user();
        $reservations = ReservationModel::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(10); // Adjust the number based on your pagination needs
        return $reservations;
    }

    public function orderlist()
    {
        $userId = auth()->id();

        $orderItems = DB::table('order_items')->join('orders', 'order_items.order_id', '=', 'orders.id')->where('orders.user_id', $userId)->select('order_items.*', 'orders.*')->orderBy('orders.id', 'desc')->paginate(10); // Adjust the number based on your pagination needs

        return $orderItems;
    }
}
