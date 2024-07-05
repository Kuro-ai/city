<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Income;
use Illuminate\Support\Facades\Validator;
use App\Models\MenuModel;
use Barryvdh\DomPDF\Facade\Pdf;


class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allIncomes = Income::orderBy('created_at', 'desc')->get();
    
        $totalPrice = 0;
        foreach ($allIncomes as $income) {
            if (is_array($income->items)) {
                foreach ($income->items as $item) {
                    $totalPrice += (float)$item['total_price'];
                }
            } else {
                $items = json_decode($income->items, true);
                foreach ($items as $item) {
                    $totalPrice += (float)$item['total_price'];
                }
            }
        }
    
        $incomes = Income::orderBy('created_at', 'desc')->paginate(10);
    
        return view('admin.incomes.index', compact('incomes', 'totalPrice'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = MenuModel::orderBy('created_at', 'desc')->get();
        return view('admin.incomes.create', ['menus' => $menus]);
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
            return redirect()->route('admin.incomes.create')->withErrors($validator)->withInput();
        } else {
            $income = new Income();
            $income->items = json_decode($request->items, true);
            $income->date = $request->date;
            $income->remark = $request->remark;
            $income->save();
        
            session()->flash('status', 'Income is successfully added!');
            return redirect()->route('admin.incomes.show', ['income' => $income->id]);
        }
    }

    public function download(string $id)
    {
        $income = Income::findOrFail($id);
        $pdf = PDF::loadView('admin.invoice', ['income' => $income]);

        session()->flash('status', 'PDF is successfully generated!');

        // Download the PDF
        return $pdf->download('invoice.pdf')->withHeaders([
            'Refresh' => '3; url=' . route('admin.incomes.show', ['income' => $income->id]),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $income = Income::findOrFail($id);
        return view('admin.incomes.index', compact('income'));
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
        $income = Income::find($id);
        $income->delete();
        session()->flash('deletestatus', 'income is successfully deleted!');

        return redirect()->route('admin.incomes.index');
    }

 
}
