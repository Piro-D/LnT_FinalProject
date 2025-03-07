<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\inventory;
use App\Models\category;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class InventoryController extends Controller
{
    public function dashboard(){
        $inventory = inventory::all();
        return view('admin.dashboard', compact('inventory'));
    }

    public function create () {
        $categories = category::all();
        return view('admin.create', compact('categories'));
    }

    public function edit (inventory $inventory) {
        $categories = category::all();
        return view('admin.update', compact('inventory', 'categories'));
    }

    // public function store (Request $request){
    //     $request->validate([
    //         'category_id' => 'required',
    //         'itemName' => 'required',
    //         'price' => 'required',
    //         'amount' => 'required',
    //         'image' => 'required',   
    //     ]);

    //     inventory::create($request->all());
    //     return redirect()->route('admin.dashboard');
    // }

    public function store(Request $request)
    {
        // Validate the input, including the image file type
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'itemName' => 'required|string|max:255',
            'price' => 'required|numeric',
            'amount' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',   
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = public_path('images'); // Store in public/images

            // Ensure directory exists
            if (!File::isDirectory($imagePath)) {
                File::makeDirectory($imagePath, 0755, true, true);
            }

            // Move the image to the public folder
            $image->move($imagePath, $imageName);
        }

        // Create inventory item
        Inventory::create([
            'category_id' => $request->category_id,
            'itemName' => $request->itemName,
            'price' => $request->price,
            'amount' => $request->amount,
            'image' => $imageName ?? null, // Save only the image filename
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Item added successfully!');
    }


    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'category_id' => 'required',
            'itemName' => 'required',
            'price' => 'required|numeric',
            'amount' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $inventory->category_id = $request->category_id;
        $inventory->itemName = $request->itemName;
        $inventory->price = $request->price;
        $inventory->amount = $request->amount;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('inventory_images', 'public');
            $inventory->image = $imagePath;
        }

        $inventory->save(); // Save the changes

        return redirect()->route('admin.dashboard')->with('success', 'Item updated successfully');
    }


    public function delete (inventory $inventory){
        $inventory->delete();
        return redirect()->route('admin.dashboard');
    }

}
