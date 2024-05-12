<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservationModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminHistoryListController extends Controller
{
    public function index()
    {
        $reservationList = $this->reservationlist();
        $orderList = $this->orderlist();

        return view('admin.index', ['reservationList' => $reservationList, 'orderList' => $orderList]);
    }

    public function reservationlist()
    {
        $reservations = ReservationModel::paginate(10);
        return $reservations;
    }

    public function orderlist()
    {
    
        $orderItems = DB::table('order_items')->join('orders', 'order_items.order_id', '=', 'orders.id')->select('order_items.*', 'orders.*')->paginate(10); // Adjust the number based on your pagination needs
        return $orderItems;
    }
}
