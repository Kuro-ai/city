<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MenuModel;
use Illuminate\Support\Facades\DB;

class CustomerMenuSearch extends Component
{
    public $search = '';
    public function render()
    {
        $result = MenuModel::query();

        if (!empty($this->search)) {
            $result->whereRaw('LOWER(name) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }

        return view('livewire.customer-menu-search', [
            'menus' => $result->paginate(10),
        ]);
    }
}
