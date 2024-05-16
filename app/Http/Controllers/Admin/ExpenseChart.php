<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseChart extends Controller
{
    public function index()
    {
        $monthlyExpenses = Expense::getMonthlyExpense();
        return view('admin.index', compact('monthlyExpenses'));
    }
}
