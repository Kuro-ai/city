<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;

class ManagerCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryModel::paginate(10);
        return view('manager.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        $existingCategory = CategoryModel::firstWhere('name', $request->category);
        if ($existingCategory) {
            return back()->withErrors(['category' => 'This Category already exists.']);
        }

        $image = getimagesize($request->file('image'));
        $width = $image[0];
        $height = $image[1];

        // Check if image is landscape
        if ($width <= $height) {
            return back()->withErrors(['image' => 'The image must be in landscape orientation.']);
        }

        $imgName = date('dmy_H_s_i') . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('categories'), $imgName);

        $categoryController = new CategoryModel();
        $categoryController->name = $request->category;
        $categoryController->description = $request->description;
        $categoryController->image = $imgName;
        $categoryController->save();

        session()->flash('status', $request->category . ' Category is successfully added!');

        return redirect()->route('manager.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = CategoryModel::find($id);

        if (!$category) {
            // Handle the case where the category doesn't exist
            return redirect()
                ->back()
                ->withErrors(['error' => 'Category not found']);
        }

        $categories = CategoryModel::find($id);
        return view('manager.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoryController = CategoryModel::find($id);
        $request->validate([
            'category' => 'required',
            'description' => 'required',
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            ]);

            $image = getimagesize($request->file('image'));
            $width = $image[0];
            $height = $image[1];

            // Check if image is landscape
            if ($width <= $height) {
                return back()->withErrors(['image' => 'The image must be in landscape orientation.']);
            }

            // Delete the old image
            $oldImagePath = public_path('categories/' . $categoryController->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Upload the new image
            $imgName = date('dmy_H_s_i') . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('categories'), $imgName);
            $categoryController->image = $imgName;
        }

        // Update other fields
        $categoryController->name = $request->category;
        $categoryController->description = $request->description;
        // $categoryController->category_id = $request->category_id;
        $categoryController->save();
        session()->flash('status', $request->category . ' category is successfully updated!');

        return redirect()->route('manager.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CategoryModel::find($id);
        $category->delete();
        session()->flash('deletestatus', $category->name . ' category is successfully deleted!');

        return redirect()->route('manager.categories.index');
    }

}
