<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'address',
        'order_date',
        'total',
        'reservation_id',
        'user_id',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItemModel::class);
    }
}