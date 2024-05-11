<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\MenuModel;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = MenuModel::all();
        return view('admin.menus.index', compact('menus'));
    }

    public function menuslist()
    {
        $menus = MenuModel::all();
        return view('admin.menus.menuslist', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryModel::all();
        return view('admin.menus.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'price' => 'required',
        ]);

        $existingMenu = MenuModel::firstWhere('name', $request->menu);
        if ($existingMenu) {
            return back()->withErrors(['menu' => 'This menu already exists.']);
        }

        $imgName = date('dmy_H_s_i') . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('menus'), $imgName);

        $menuController = new MenuModel();
        $menuController->name = $request->menu;
        $menuController->description = $request->description;
        $menuController->image = $imgName;
        $menuController->price = $request->price;
        $menuController->category_id = $request->category_id;
        $menuController->save();

        session()->flash('status', $request->menu . ' menu is successfully added!');

        return redirect()->route('admin.menus.index');
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
        $menu = MenuModel::find($id);
        if (!$menu) {
            // Handle the case where no menu with the given id was found
            // For example, you might want to redirect back with an error message
            return redirect()
                ->back()
                ->withErrors(['error' => 'Menu not found']);
        }

        $categories = CategoryModel::all();
        return view('admin.menus.edit')->with('menu', $menu)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menuController = MenuModel::find($id);
        $request->validate([
            'menu' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            // Delete the old image
            $oldImagePath = public_path('menus/' . $menuController->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Upload the new image
            $imgName = date('dmy_H_s_i') . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('menus'), $imgName);
            $menuController->image = $imgName;
        }

        // Update other fields
        $menuController->name = $request->menu;
        $menuController->description = $request->description;
        $menuController->price = $request->price;
        $menuController->category_id = $request->category_id;
        $menuController->save();
        session()->flash('status', $request->menu . ' menu is successfully updated!');

        return redirect()->route('admin.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = MenuModel::find($id);
        $menu->delete();
        session()->flash('deletestatus', $menu->name . ' menu is successfully deleted!');

        return redirect()->route('admin.menus.index');
    }
}
