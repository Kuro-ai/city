<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'price', 'category_id'];

    public function category()
    {
        return $this->hasmany("App\Models\CategoryModel", "id", "category_id");
    }
}
