<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerReservationController extends Controller
{
    public function stepOne()
    {
        return view('customer.reservations.step-one');
    }
}
