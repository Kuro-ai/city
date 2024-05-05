<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\MenuModel;

class CustomerCategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryModel::all();
        return view('customer.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $menus = MenuModel::where('category_id', $id)->get();

        return view('customer.categories.show', ['menus' => $menus]);
    }
}
