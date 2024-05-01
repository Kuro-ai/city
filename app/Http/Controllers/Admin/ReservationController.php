<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReservationModel;
use App\Models\TableModel;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = ReservationModel::all();
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = TableModel::all();
        return view('admin.reservations.create')->with('tables', $tables);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'tel_number' => 'required',
            'res_date' => 'required',
            'guest_number' => 'required',
        ]);

        $reservationController = new ReservationModel();
        $reservationController->first_name = $request->first_name;
        $reservationController->last_name = $request->last_name;
        $reservationController->email = $request->email;
        $reservationController->tel_number = $request->tel_number;
        $reservationController->res_date = $request->res_date;
        $reservationController->table_id = $request->table_id;
        $reservationController->guest_number = $request->guest_number;
        $reservationController->save();

        $request->session()->flash('status', 'You are successfully Reserved!');

        return redirect()->route('admin.reservations.index');
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

        $tables = TableModel::all();
        return view('admin.reservations.edit')->with('reservation', $reservation)->with('tables', $tables);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservationController = ReservationModel::find($id);
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'tel_number' => 'required',
            'res_date' => 'required',
            'guest_number' => 'required',
        ]);

        // Update other fields
        $reservationController->first_name = $request->first_name;
        $reservationController->last_name = $request->last_name;
        $reservationController->email = $request->email;
        $reservationController->tel_number = $request->tel_number;
        $reservationController->res_date = $request->res_date;
        $reservationController->table_id = $request->table_id;
        $reservationController->guest_number = $request->guest_number;
        $reservationController->save();

        $request->session()->flash('status', 'Your Reservation is successfully updated!');

        return redirect()->route('admin.reservations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = ReservationModel::find($id);
        $reservation->delete();
        session()->flash('deletestatus',  'Your Reservation is successfully deleted!');

        return redirect()->route('admin.reservations.index');
    }
}
