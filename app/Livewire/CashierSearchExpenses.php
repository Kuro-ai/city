<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CashierSearchExpenses extends Component
{

    public $search = '';
    public function render()
    {
        $result = Expense::query();

        if (!empty($this->search)) {
            $date = Carbon::parse($this->search)->format('Y-m-d');
            $result->whereDate('date', $date);
        }

        return view('livewire.cashier-search-expenses', [
            'expenses' => $result->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
