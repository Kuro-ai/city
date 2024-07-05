<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CategoryModel;

class ManagerCategorySearch extends Component
{
    public $search = '';
    public function render()
    {
        $result = CategoryModel::query();

        if (!empty($this->search)) {
            $result->whereRaw('LOWER(name) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }

        return view('livewire.manager-category-search', [
            'categories' => $result->paginate(10),
        ]);
    }
}
