<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['items', 'date', 'remark'];

    protected $casts = [
        'items' => 'array',
    ];

    public static function getMonthlyExpense()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $expenses = self::select(['items', DB::raw('EXTRACT(MONTH FROM date) as month')])->get();

        $monthlyExpenses = array_fill_keys($months, 0);

        foreach ($expenses as $expense) {
            $items = is_array($expense->items) ? $expense->items : json_decode($expense->items, true);
            $month = $months[$expense->month - 1];
            foreach ($items as $item) {
                $monthlyExpenses[$month] += floatval($item['total_price']);
            }
        }

        $result = [];
        foreach ($monthlyExpenses as $month => $total) {
            $result[] = (object) ['month' => $month, 'total' => $total];
        }

        return collect($result);
    }
    public static function getWeeklyExpense()
    {
        $expenses = self::select(['items', DB::raw('EXTRACT(WEEK FROM date) as week_number')])->get();

        $weeklyExpenses = [];

        foreach ($expenses as $expense) {
            $weekNumber = $expense->week_number;
            $items = is_array($expense->items) ? $expense->items : json_decode($expense->items, true);

            if (!isset($weeklyExpenses[$weekNumber])) {
                $weeklyExpenses[$weekNumber] = 0;
            }

            foreach ($items as $item) {
                $weeklyExpenses[$weekNumber] += floatval($item['total_price']);
            }
        }

        $result = [];
        for ($week = 1; $week <= 53; $week++) {
            $result[] = (object) ['week' => $week, 'total' => $weeklyExpenses[$week] ?? 0];
        }

        return collect($result);
    }

    public static function getDailyExpense()
{
    $expenses = self::select(['items', DB::raw('date::date as day')])
        ->get();

    $dailyExpenses = [];

    foreach ($expenses as $expense) {
        $day = $expense->day;
        $items = is_array($expense->items) ? $expense->items : json_decode($expense->items, true);
        
        if (!isset($dailyExpenses[$day])) {
            $dailyExpenses[$day] = 0;
        }

        foreach ($items as $item) {
            $dailyExpenses[$day] += floatval($item['total_price']);
        }
    }

    $result = [];
    $startDate = now()->startOfYear();
    $endDate = now()->endOfYear();

    for ($date = $startDate; $date <= $endDate; $date->addDay()) {
        $day = $date->format('Y-m-d');
        $result[] = (object) ['day' => $day, 'total' => $dailyExpenses[$day] ?? 0];
    }

    return collect($result);
}
}
