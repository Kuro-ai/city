<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
}
