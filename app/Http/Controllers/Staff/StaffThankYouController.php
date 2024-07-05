<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffThankYouController extends Controller
{
    public function staffthankyou()
    {
        return view('staff.thankyou');
    }

    
}
