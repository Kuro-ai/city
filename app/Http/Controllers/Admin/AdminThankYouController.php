<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminThankYouController extends Controller
{
    public function adminthankyou()
    {
        return view('admin.thankyou');
    }

    
}
