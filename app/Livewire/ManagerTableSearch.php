<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TableModel;

class ManagerTableSearch extends Component
{

    public $search = '';
    public function render()
    {
        $result = TableModel::query();

        if (!empty($this->search)) {
            $result->whereRaw('LOWER(name) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }

        return view('livewire.manager-table-search', [
            'tables' => $result->paginate(10),
        ]);
    }
}
