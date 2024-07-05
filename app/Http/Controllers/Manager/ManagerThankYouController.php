<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerThankYouController extends Controller
{
    public function managerthankyou()
    {
        return view('manager.thankyou');
    }

    
}
