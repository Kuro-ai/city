<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
class ManagerExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::orderBy('created_at', 'desc')->paginate(10);
        return view('manager.expenses.index', compact('expenses'));
    }

    public function create()
    {
        return view('manager.expenses.create');
    }

  
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|json|min:1', 
            'date' => 'required|date',
            'remark' => 'nullable|string',
            'menu_name.*' => 'required|string', 
            'quantity.*' => 'required|integer|min:1', 
            'total_price.*' => 'required|numeric|min:0', 
        ]);
        
        if ($validator->fails()) {
            session()->flash('error', 'Please add quantity for the menu items!.');
            return redirect()->route('manager.expenses.create')->withErrors($validator)->withInput();
        } else {
            $expense = new Expense();
            $expense->items = json_decode($request->items, true);
            $expense->date = $request->date;
            $expense->remark = $request->remark;
            $expense->save();
        
            session()->flash('status', 'Expense is successfully added!');
            return redirect()->route('manager.expenses.show', ['expense' => $expense->id]);
        }
    }
    public function download(string $id)
    {
        $expense = Expense::findOrFail($id);
        $pdf = PDF::loadView('manager.purchaseList', ['expense' => $expense]);

        session()->flash('status', 'PDF is successfully generated!');
        return $pdf->download('purchaseList.pdf')->withHeaders([
            'Refresh' => '3; url=' . route('manager.expenses.show', ['expense' => $expense->id]),
        ]);
    }

    public function show(string $id)
    {
        $expense = Expense::findOrFail($id);
        return view('manager.expenses.index', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        return view('manager.expenses.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $expense = Expense::findOrFail($id);

        $expense->items = json_decode($request->items, true);
        $expense->date = $request->date;
        $expense->remark = $request->remark;

        $expense->save();

        session()->flash('status', 'Expense is successfully updated!');
        return redirect()->route('manager.expenses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::find($id);
        $expense->delete();
        session()->flash('deletestatus', 'Expense is successfully deleted!');
    
        return redirect()->route('manager.expenses.index');
    }
}