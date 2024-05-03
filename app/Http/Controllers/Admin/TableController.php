<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TableModel;


class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = TableModel::all();
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'table' => 'required',
            'capacity' => 'required',
            'status' => 'required',
            'location' => 'required',
        ]);

        $existingTable = TableModel::firstWhere('name', $request->table);
        if ($existingTable) {
            return back()->withErrors(['table' => 'This Table already exists.']);
        }

        $tableController = new TableModel();
        $tableController->name = $request->table;
        $tableController->capacity = $request->capacity;
        $tableController->status = $request->status;
        $tableController->location = $request->location;
        $tableController->save();

        session()->flash('status', $request->table . ' Table is successfully added!');

        return redirect()->route('admin.tables.index');
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
        $table = TableModel::find($id);
        return view('admin.tables.edit',  compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tableController = TableModel::find($id);
        $request->validate([
            'table' => 'required',
            'capacity' => 'required',
            'status' => 'required',
            'location' => 'required',
        ]);


        // Update other fields
        $tableController->name = $request->table;
        $tableController->capacity = $request->capacity;
        $tableController->status = $request->status;
        $tableController->location = $request->location;
        $tableController->save();
        session()->flash('status', $request->table . ' table is successfully updated!');

        return redirect()->route('admin.tables.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $table = TableModel::find($id);
        $table->delete();
        session()->flash('deletestatus', $table->name. ' table is successfully deleted!');
    
        return redirect()->route('admin.tables.index');
    }
}
