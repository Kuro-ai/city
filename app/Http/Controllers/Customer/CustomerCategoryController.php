<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CustomerCategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryModel::all();
        return view('customer.categories.index', compact('categories'));
    }
}
