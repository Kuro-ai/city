<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class UserSearch extends Component
{
    public $search = '';
    public function render()
    {
         $result = User::where('is_admin', 0);

        if (!empty($this->search)) {
            $result->whereRaw('LOWER(email) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }

        return view('livewire.user-search', [
            'users' => $result->paginate(10),
        ]);
    }
}
