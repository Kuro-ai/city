<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\MenuModel;

class SpecialsController extends Controller
{
    public function index()
    {
        $category = CategoryModel::where('name', 'Specials')->first();
        if ($category) {
            $menus = MenuModel::where('category_id', $category->id)->get();
        } else {
            $menus = collect(); // empty collection
        }
        return view('customer.index', ['menus' => $menus]);

    }
}
