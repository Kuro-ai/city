<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;

class ManagerIncomeChart extends Controller
{
    public function index()
    {
        $monthlyIncomes = Income::getMonthlyIncome();
        return view('manager.index', compact('monthlyIncomes'));
    }
}
