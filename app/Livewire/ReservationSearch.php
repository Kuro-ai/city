<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ReservationModel;
use Illuminate\Support\Facades\DB;

class ReservationSearch extends Component
{
    public $search = '';
    public function render()
    {
        $result = ReservationModel::query();

        if (!empty($this->search)) {
            $result->where(function ($query) {
                $searchTerm = strtolower('%' . $this->search . '%');
                $query->whereRaw('LOWER(first_name) LIKE ?', [$searchTerm])
                      ->orWhereRaw('LOWER(last_name) LIKE ?', [$searchTerm])
                      ->orWhereRaw('LOWER(email) LIKE ?', [$searchTerm]);
            });
        }

        return view('livewire.reservation-search', [
            'reservations' => $result->paginate(10),
        ]);
    }
}