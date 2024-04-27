<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TableStatus;
use App\Enums\TableLocation;

class TableModel extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'capacity', 'status', 'location'];

    protected $casts = [
        'status' => TableStatus::class,
        'location' => TableLocation::class
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
