<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Builder::macro('search', function ($field, $string) {
            return $string? $this->where($field, 'like', '%'.$string.'%') : $this;
        });

        View::composer('*', function ($view) {
            $view->with('monthlyExpenses', Expense::getMonthlyExpense());
        });

        View::composer('*', function ($view) {
            $view->with('monthlyIncomes', Income::getMonthlyIncome());
        });
    
    }
}
