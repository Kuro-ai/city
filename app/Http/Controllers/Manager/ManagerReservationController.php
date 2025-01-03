<?php

namespace App\Http\Controllers\Manager;

use App\Enums\TableStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservationModel;
use App\Models\TableModel;
use App\Models\OrderModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;
use App\Mail\ReservationCancellation;

class ManagerReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $reservations = ReservationModel::orderBy('id', 'desc')->paginate(10);
        return view('manager.reservations.index', ['reservations' => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = TableModel::where('status', TableStatus::Available)->get();
        return view('manager.reservations.create')->with('tables', $tables);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['user_id'] = \Illuminate\Support\Facades\Auth::id();
        $table = TableModel::find($request->table_id);

        if (!$table) {
            throw ValidationException::withMessages([
                'table_id' => ['The selected table does not exist.'],
            ]);
        }
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'tel_number' => 'required',
            'res_date' => 'required | date | after_or_equal:now',
            'guest_number' => 'required | integer | max:' . $table->capacity,
            'user_id' => ['required'],
        ]);

        $existingReservation = ReservationModel::where('table_id', $request->table_id)
            ->where('res_date', $request->res_date)
            ->first();

        if ($existingReservation) {
            throw ValidationException::withMessages([
                'table_id' => ['This table is already booked at the selected date and time by another reservation.'],
            ]);
        }

        $reservationController = new ReservationModel();
        $reservationController->first_name = $request->first_name;
        $reservationController->last_name = $request->last_name;
        $reservationController->email = $request->email;
        $reservationController->tel_number = $request->tel_number;
        $reservationController->res_date = $request->res_date;
        $reservationController->table_id = $request->table_id;
        $reservationController->guest_number = $request->guest_number;
        $reservationController->user_id = $request->user_id;
        $reservationController->save();

        // Store the id of the new reservation in the session
        session(['reservation_id' => $reservationController->id]);

        $table = TableModel::find($request->table_id);
        if ($table) {
            $table->status = TableStatus::Unavailable;
            $table->save();
        }

        return redirect()->route('manager.thankyou');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = ReservationModel::find($id);
        if (!$reservation) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Menu not found']);
        }

        $tables = TableModel::where('status', TableStatus::Available)->get();
        return view('manager.reservations.edit')->with('reservation', $reservation)->with('tables', $tables);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservationController = ReservationModel::find($id);
        $table = TableModel::find($request->table_id);

        if (!$table) {
            throw ValidationException::withMessages([
                'table_id' => ['The selected table does not exist.'],
            ]);
        }
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'tel_number' => 'required',
            'res_date' => 'required',
            'guest_number' => 'required',
        ]);

        $existingReservation = ReservationModel::where('table_id', $request->table_id)
            ->where('res_date', $request->res_date)
            ->first();

        if ($existingReservation) {
            throw ValidationException::withMessages([
                'table_id' => ['This table is already booked at the selected date and time by another reservation.'],
            ]);
        }

        // Update other fields
        $reservationController->first_name = $request->first_name;
        $reservationController->last_name = $request->last_name;
        $reservationController->email = $request->email;
        $reservationController->tel_number = $request->tel_number;
        $reservationController->res_date = $request->res_date;
        $reservationController->table_id = $request->table_id;
        $reservationController->guest_number = $request->guest_number;
        $reservationController->save();

        $table = TableModel::find($request->table_id);
        if ($table) {
            $table->status = TableStatus::Unavailable;
            $table->save();
        }

        session()->flash('status', 'Reservation is successfully updated!');

        return redirect()->route('manager.reservations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = ReservationModel::with('orderItems', 'order', 'user')->find($id);
        $user = $reservation->user;
        foreach ($reservation->orderItems as $orderItem) {
            $orderItem->delete();
        }
        if ($reservation->order) {
            foreach ($reservation->order->orderItems as $orderItem) {
                $orderItem->delete();
            }
            $reservation->order->delete();
        }
        $table = TableModel::find($reservation->table_id);
        if ($table) {
            $table->status = TableStatus::Available;
            $table->save();
        }
        $reservation->delete();
        Mail::to($reservation->email)->send(new ReservationCancellation($reservation, $user));
        session()->flash('deletestatus', 'Reservation and associated order items successfully deleted!');
        return redirect()->route('manager.reservations.index');
    }

    public function reservationemail($id)
    {
        $reservation = DB::table('reservation_models')
        ->join('users', 'reservation_models.user_id', '=', 'users.id')
        ->select('reservation_models.*', 'users.name as username', 'users.email as useremail')
        ->where('reservation_models.id', $id)
        ->first();
    
        $username = $reservation->username ? $reservation->username : 'User not found';
        $useremail = $reservation->useremail ? $reservation->useremail : 'Email not found';
    
        $email = new ReservationConfirmation($reservation, $username, $useremail);
    
        Mail::to($useremail)->send($email);
    
        DB::table('reservation_models')
            ->where('id', $reservation->id)
            ->update(['email_sent' => true]);
    
        return redirect()->route('manager.reservations.index')->with('status', 'Email is successfully sent!');
    }
}
