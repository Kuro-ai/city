<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'menu_id',
        'reservation_id',
    ];

    public function menu()
    {
        return $this->belongsTo(MenuModel::class);
    }

    public function reservation()
    {
        return $this->belongsTo(ReservationModel::class);
    }
}