<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\MenuModel;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomes = Income::paginate(10);
        return view('admin.incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = MenuModel::all();
        return view('admin.incomes.create', ['menus' => $menus]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required',
            'date' => 'required|date',
            'remark' => 'nullable|string',
        ]);

        $income = new Income();
        $income->items = json_decode($request->items, true);
        $income->date = $request->date;
        $income->remark = $request->remark;
        $income->save();

        session()->flash('status', 'Income is successfully added!');
        return redirect()->route('admin.incomes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $income = Income::findOrFail($id);
        return view('admin.incomes.show', compact('income'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $income = Income::findOrFail($id);
        $menus = MenuModel::all(); 
        return view('admin.incomes.edit', compact('income', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $income = Income::findOrFail($id);

        $income->items = json_decode($request->items, true);
        $income->date = $request->date;
        $income->remark = $request->remark;

        $income->save();

        session()->flash('status', 'Income is successfully updated!');
        return redirect()->route('admin.incomes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
