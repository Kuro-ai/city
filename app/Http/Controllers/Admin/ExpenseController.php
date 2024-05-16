<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'total_price' => 'required|numeric',
            'date' => 'required|date',
            'remark' => 'nullable|string',
        ]);

        Expense::create($validatedData);

        session()->flash('status', 'Expense is successfully added!');

        return redirect()->route('admin.expenses.index');
    }

    public function show(Expense $expense)
    {
        return view('admin.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        return view('admin.expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'remark' => 'nullable|string',
        ]);

        $expense->update($validatedData);

        session()->flash('status', 'Expense is successfully updated!');

        return redirect()->route('admin.expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::find($id);
        $expense->delete();
        session()->flash('deletestatus', 'Expense is successfully deleted!');
    
        return redirect()->route('admin.expenses.index');
    }
}
