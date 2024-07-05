<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ManagerExpenseChart extends Controller
{
    public function index()
    {
        $monthlyExpenses = Expense::getMonthlyExpense();
        return view('manager.index', compact('monthlyExpenses'));
    }
}
