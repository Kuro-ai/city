<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TableModel;
use Illuminate\Support\Facades\DB;

class TableSearch extends Component
{
    public $search = '';
    public function render()
    {
        $result = TableModel::query();

        if (!empty($this->search)) {
            $result->whereRaw('LOWER(name) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }

        return view('livewire.table-search', [
            'tables' => $result->paginate(10),
        ]);
    }
}
