<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class ProfitChart extends Controller
{
    public function index()
    {
        $data = $this->getMonthlyProfit();
        return view('admin.index', compact('data'));
    }
    public function getMonthlyProfit()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $incomes = Income::select(['items', DB::raw('EXTRACT(MONTH FROM date) as month')])->get();
        $expenses = Expense::select(['total_price', DB::raw('EXTRACT(MONTH FROM date) as month')])->get();

        $monthlyIncomes = array_fill_keys($months, 0);
        $monthlyExpenses = array_fill_keys($months, 0);

        foreach ($incomes as $income) {
            $items = is_array($income->items) ? $income->items : json_decode($income->items, true);
            $month = $months[$income->month - 1];
            foreach ($items as $item) {
                $monthlyIncomes[$month] += floatval($item['total_price']);
            }
        }

        foreach ($expenses as $expense) {
            $month = $months[$expense->month - 1];
            $monthlyExpenses[$month] += floatval($expense->total_price);
        }

        $result = [];
        foreach ($months as $month) {
            $profit = $monthlyIncomes[$month] - $monthlyExpenses[$month];
            $result[] = (object) ['month' => $month, 'profit' => $profit];
        }

        return collect($result);
    }
}
