<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
}
