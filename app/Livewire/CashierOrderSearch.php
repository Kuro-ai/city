<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class CashierOrderSearch extends Component
{

    public $search = '';
    public function render()
    {
        $result = DB::table('order_items')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->select('order_items.*', 'orders.*');

        if (!empty($this->search)) {
            $searchTerm = strtolower('%' . $this->search . '%');
            $result->where(function ($query) use ($searchTerm) {
                $query->WhereRaw('LOWER(orders.first_name) LIKE ?', [$searchTerm])
                      ->orWhereRaw('LOWER(orders.last_name) LIKE ?', [$searchTerm])
                      ->orWhereRaw('LOWER(orders.email) LIKE ?', [$searchTerm]);
            });
        }

        return view('livewire.cashier-order-search', [
            'orders' => $result->orderBy('order_items.id', 'desc')->paginate(10),
        ]);
    }
}
