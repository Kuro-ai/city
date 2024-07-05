<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;

class CashierIncomeChart extends Controller
{
    public function index()
    {
        $monthlyIncomes = Income::getMonthlyIncome();
        return view('cashier.index', compact('monthlyIncomes'));
    }
}
