<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function index()
    {
        return view('admin.index');
    }



    public function productsAdmin()
    {
        $products = Product::all();
        return view('admin.adminProducts', compact('products'));
    }




    public function deleteProduct(int $id)
    {
        $product = Product::find($id);

        if ($product == null) {
            return redirect('/admin-products')->with('error', 'No product found with that id');
        }

        $product->delete();
        return redirect('/admin-products')->with('success', 'Product removed!');
    }




    public function addnewProduct(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max size: 10MB
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $product->image = $imageName; // Save the image file path to the database
        }

        $product->save();

        return redirect('/admin-products')->with('message', 'New Product Added Successfully!');
    }




    public function updateProduct(Request $request)
    {
        $product = Product::find($request->input("id"));
        if (!$product) {
            return redirect('/admin-products')->with('error', 'Product not found!');
        }

        $product->name = $request->input("name");
        $product->description = $request->input("description");
        $product->price = $request->input("price");

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/products/', $imageName);
            $product->image = $imageName;
        }

        $product->save();
        return redirect('/admin-products')->with('message', 'Product Updated Successfully!');
    }
    
}
