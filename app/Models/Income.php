<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Income extends Model
{
    use HasFactory;
    protected $fillable = ['items', 'date', 'remark'];

    protected $casts = [
        'items' => 'array',
    ];

    public static function getMonthlyIncome()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    
        $incomes = self::select(['items', DB::raw('EXTRACT(MONTH FROM date) as month')])->get();
    
        $monthlyIncomes = array_fill_keys($months, 0);
    
        foreach ($incomes as $income) {
            $items = is_array($income->items) ? $income->items : json_decode($income->items, true);
            $month = $months[$income->month - 1];
            foreach ($items as $item) {
                $monthlyIncomes[$month] += floatval($item['total_price']);
            }
        }
    
        $result = [];
        foreach ($monthlyIncomes as $month => $total) {
            $result[] = (object) ['month' => $month, 'total' => $total];
        }
    
        return collect($result);
    }

    public static function getWeeklyIncome()
    {
        $incomes = self::select(['items', DB::raw('EXTRACT(WEEK FROM date) as week_number')])
            ->get();
    
        $weeklyIncomes = [];
    
        foreach ($incomes as $income) {
            $weekNumber = $income->week_number;
            $items = is_array($income->items) ? $income->items : json_decode($income->items, true);
            
            if (!isset($weeklyIncomes[$weekNumber])) {
                $weeklyIncomes[$weekNumber] = 0;
            }
    
            foreach ($items as $item) {
                $weeklyIncomes[$weekNumber] += floatval($item['total_price']);
            }
        }
    
        $result = [];
        foreach ($weeklyIncomes as $week => $total) {
            $result[] = (object) ['week' => $week, 'total' => $total];
        }
    
        return collect($result);
    }

    public static function getDailyIncome()
    {
        $incomes = self::select(['items', DB::raw('date::date as day')])
            ->get();
    
        $dailyIncomes = [];
    
        foreach ($incomes as $income) {
            $day = $income->day;
            $items = is_array($income->items) ? $income->items : json_decode($income->items, true);
            
            if (!isset($dailyIncomes[$day])) {
                $dailyIncomes[$day] = 0;
            }
    
            foreach ($items as $item) {
                $dailyIncomes[$day] += floatval($item['total_price']);
            }
        }
    
        $result = [];
        foreach ($dailyIncomes as $day => $total) {
            $result[] = (object) ['day' => $day, 'total' => $total];
        }
    
        return collect($result);
    }
}
