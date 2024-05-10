<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationModel extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'tel_number', 'res_date', 'guest_number', 'table_id', 'user_id'];

    public function table()
    {
        return $this->hasmany('App\Models\TableModel', 'id', 'table_id');
    }

    protected $dates = ['res_date'];

    public function tables()
    {
        return $this->belongsTo(TableModel::class);
    }
}
