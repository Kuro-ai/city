<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class CashierExpenseChart extends Controller
{
    public function index()
    {
        $monthlyExpenses = Expense::getMonthlyExpense();
        return view('cashier.index', compact('monthlyExpenses'));
    }
}
