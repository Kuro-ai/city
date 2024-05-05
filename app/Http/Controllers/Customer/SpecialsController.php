<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\MenuModel;

class SpecialsController extends Controller
{
    public function thankyou()
    {
        return view('thankyou');
    }
}
