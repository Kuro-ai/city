<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MenuModel;
use App\Models\CategoryModel;
use Illuminate\Support\Facades\DB;

class MenuSearch extends Component
{
    public $search = '';
    public $category = '';
    public function render()
    {
        $result = MenuModel::query();
        $categories = CategoryModel::all();

        if (!empty($this->search)) {
            $result->whereRaw('LOWER(name) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }

        if (!empty($this->category)) {
            $categories->where('category', $this->category);
        }

        return view('livewire.menu-search', [
            'menus' => $result->paginate(10),
            'categories' => $categories,
        ]);
    }
}
