<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'quantity', 'total_price', 'date', 'remark'];

    public static function getMonthlyExpense()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $expenses = self::select(DB::raw('SUM(total_price) as total'), DB::raw('EXTRACT(MONTH FROM date)::integer as month'))
            ->groupBy(DB::raw('EXTRACT(MONTH FROM date)::integer'))
            ->orderBy(DB::raw('EXTRACT(MONTH FROM date)::integer'), 'asc')
            ->get()
            ->mapWithKeys(function ($item) use ($months) {
                return [$months[$item->month - 1] => $item->total];
            });

        $result = [];
        foreach ($months as $month) {
            $result[] = (object) ['month' => $month, 'total' => $expenses[$month] ?? 0];
        }

        return collect($result);
    }
}
