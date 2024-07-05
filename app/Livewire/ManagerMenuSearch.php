<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MenuModel;
use App\Models\CategoryModel;

class ManagerMenuSearch extends Component
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

        return view('livewire.manager-menu-search', [
            'menus' => $result->get(),
            'categories' => $categories,
        ]);
    }

}
