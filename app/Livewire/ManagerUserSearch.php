<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class ManagerUserSearch extends Component
{

    public $search = '';
    public $selectedRole = '';
    public function render()
    {
        $query = User::query();
        $query = User::whereNotIn('userRole', ['admin', 'manager']);

        if (!empty($this->search)) {
            $query->whereRaw('LOWER(email) LIKE ?', [strtolower('%' . $this->search . '%')]);
        }

        if (!empty($this->selectedRole)) {
            $query->where('userRole', $this->selectedRole);
        }
        return view('livewire.manager-user-search', [
            'users' => $query->paginate(10),
        ]);
    }

    public function updateUserRole($userId, $role)
    {
        $user = User::find($userId);
        if ($user) {
            $user->userRole = $role;
            $user->save();

            session()->flash('status', $user->email . "'s user role is successfully changed to " . $user->userRole . ".");
            return redirect()->route('manager.user.index');
        }
    }

}
