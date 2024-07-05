<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Income;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManagerSearchIncomes extends Component
{

    public $search = '';

    public function render()
    {
        $result = Income::query();

        if (!empty($this->search)) {
            $date = Carbon::parse($this->search)->format('Y-m-d');
            $result->whereDate('date', $date);
        }

        return view('livewire.manager-search-incomes', [
            'incomes' => $result->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

}
