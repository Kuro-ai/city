<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;

class IncomeChart extends Controller
{
    public function index()
    {
        $monthlyIncomes = Income::getMonthlyIncome();
        return view('admin.index', compact('monthlyIncomes'));
    }
}
