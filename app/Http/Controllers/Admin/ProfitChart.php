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
        $monthlyProfit = $this->getMonthlyProfit();
        $weeklyProfit = $this->getWeeklyProfit();
        $dailyProfit = $this->getDailyProfit();
        
        $monthlyIncomes = Income::getMonthlyIncome();
        $monthlyExpenses = Expense::getMonthlyExpense();
        $weeklyIncomes = Income::getWeeklyIncome();
        $weeklyExpenses = Expense::getWeeklyExpense();
        $dailyIncomes = Income::getDailyIncome();
        $dailyExpenses = Expense::getDailyExpense();

        return view('admin.index', compact(
            'monthlyProfit',
            'weeklyProfit',
            'dailyProfit',
            'monthlyIncomes',
            'monthlyExpenses',
            'weeklyIncomes',
            'weeklyExpenses',
            'dailyIncomes',
            'dailyExpenses'
        ));
    }
    public function getMonthlyProfit()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $incomes = Income::select(['items', DB::raw('EXTRACT(MONTH FROM date) as month')])->get();
        $expenses = Expense::select(['items', DB::raw('EXTRACT(MONTH FROM date) as month')])->get();

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
            $items = is_array($expense->items) ? $expense->items : json_decode($expense->items, true);
            $month = $months[$expense->month - 1];
            foreach ($items as $item) {
                $monthlyExpenses[$month] += floatval($item['total_price']);
            }
        }

        $result = [];
        foreach ($months as $month) {
            // Correct calculation of profit by subtracting expenses from incomes
            $profit = $monthlyIncomes[$month] - $monthlyExpenses[$month];
            $result[] = (object) ['month' => $month, 'profit' => $profit];
        }

        return collect($result);
    }
    public function getWeeklyProfit()
    {
        $weeklyIncomes = Income::getWeeklyIncome();
        $weeklyExpenses = Expense::getWeeklyExpense();

        $weeklyProfits = [];

        foreach ($weeklyIncomes as $weeklyIncome) {
            $weeklyExpense = $weeklyExpenses->firstWhere('week', $weeklyIncome->week);
            $profit = $weeklyIncome->total - ($weeklyExpense ? $weeklyExpense->total : 0);
            $weeklyProfits[] = (object) ['week' => $weeklyIncome->week, 'profit' => $profit];
        }

        return collect($weeklyProfits);
    }

    public function getDailyProfit()
    {
        $dailyIncomes = Income::getDailyIncome();
        $dailyExpenses = Expense::getDailyExpense();

        $dailyProfits = [];

        foreach ($dailyIncomes as $dailyIncome) {
            $dailyExpense = $dailyExpenses->firstWhere('day', $dailyIncome->day);
            $profit = $dailyIncome->total - ($dailyExpense ? $dailyExpense->total : 0);
            $dailyProfits[] = (object) ['day' => $dailyIncome->day, 'profit' => $profit];
        }

        return collect($dailyProfits);
    }
}
