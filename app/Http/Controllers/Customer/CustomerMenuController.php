<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuModel;

class CustomerMenuController extends Controller
{
    public function index()
    {
        $menus = MenuModel::all();

        return view('customer.menus.index', compact('menus'));
    }
}
