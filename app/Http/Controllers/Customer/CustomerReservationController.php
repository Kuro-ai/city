<?php

namespace App\Http\Controllers\Customer;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use App\Models\ReservationModel;
use App\Models\TableModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotification;
use App\Models\User;

class CustomerReservationController extends Controller
{
    public function stepOne(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        $min_date = Carbon::today();
        $max_date = Carbon::now()->addWeek();
        return view('customer.reservations.step-one', compact('reservation', 'min_date', 'max_date'));
    }

    public function storeStepOne(Request $request)
    {
        $request['user_id'] = \Illuminate\Support\Facades\Auth::id();
        $validated = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'tel_number' => ['required'],
            'user_id' => ['required'],
        ]);

        if (empty($request->session()->get('reservation'))) {
            $reservation = new ReservationModel();
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        } else {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $request->session()->put('reservation', $reservation);
        }

        return to_route('customer.reservations.step.two');
    }

    public function stepTwo(Request $request)
    {
        $reservation = $request->session()->get('reservation');
        $res_table_ids = ReservationModel::orderBy('res_date')
            ->get()
            ->filter(function ($value) use ($reservation) {
                return strtotime($value->res_date) == strtotime($reservation->res_date);
            })
            ->pluck('table_id');
        $tables = TableModel::where('status', TableStatus::Available)

            ->whereNotIn('id', $res_table_ids)
            ->get();
        return view('customer.reservations.step-two', compact('reservation', 'tables'));
    }

    public function storeStepTwo(Request $request)
    {
        $validated = $request->validate([
            'res_date' => ['required', 'date'],
            'guest_number' => ['required'],
            'table_id' => ['required'],
        ]);

        $table = TableModel::find($request->table_id);
        if ($table) {
            $table->status = TableStatus::Unavailable;
            $table->save();
        }
        if ($request->session()->has('reservation')) {
            $reservation = $request->session()->get('reservation');
            $reservation->fill($validated);
            $reservation->save();

            // Use the session() helper function to store the reservation object in the session
            session(['reservation' => $reservation]);

            // Get all admin users
            $adminUsers = User::where('is_admin', true)->get();

            // Send an email to each admin user
            foreach ($adminUsers as $admin) {
                Mail::to($admin->email)->send(new AdminNotification($reservation->first_name . ' ' . $reservation->last_name, $reservation->email, $reservation->id));
            }
            return to_route('thankyou');
        } else {
            return view('customer.reservations.step-one');
        }
    }
}
