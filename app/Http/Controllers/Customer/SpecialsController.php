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
            $specials = MenuModel::where('category_id', $category->id)->get();
        } else {
            $specials = collect(); // empty collection
        }
        return view('customer.index', ['specials' => $specials]);

    }

    public function thankyou()
    {
        return view('thankyou');
    }
}
