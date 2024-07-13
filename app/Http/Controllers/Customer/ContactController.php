<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('customer.customercontact');
    }

    public function showTerms()
    {
        return view('customer.terms');
    }

    public function sendEmail(Request $request)
    {
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        $adminUsers = User::whereIn('userRole', ['admin', 'manager'])->get();

        // Send an email to each admin user
        foreach ($adminUsers as $admin) {
            Mail::to($admin->email)->send(new \App\Mail\ContactMail($details));
        }

        session()->flash('status', 'Mail is successfully sent!');
        return redirect()->route('customer.index');
    }
}
