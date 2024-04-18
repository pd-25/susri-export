<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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






//     public function addNewProduct(Request $request)
// {
//     $validatedData = $request->validate([
//         'name' => 'required|string|max:255',
//         'description' => 'nullable|string',
//         'price' => 'required|numeric|min:0',
//         'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max size: 10MB for each image
//     ]);

//     $product = new Product();
//     $product->name = $validatedData['name'];
//     $product->description = $validatedData['description'];
//     $product->price = $validatedData['price'];

//     $imagePaths = [];
//     if ($request->hasFile('images')) {
//         foreach ($request->file('images') as $image) {
//             $imageName = time() . '_' . $image->getClientOriginalName();
//             $image->move(public_path('uploads/products'), $imageName);
//             $imagePaths[] = 'uploads/products/' . $imageName; // Store image paths in an array
//         }
//     }

//     $product->image = $imagePaths; // Save the array of image file paths to the database

//     $product->save();

//     return redirect('/admin-products')->with('message', 'New Product Added Successfully!');
// }




public function addNewProduct(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // Max size: 10MB for each image
    ]);

    $product = new Product();
    $product->name = $validatedData['name'];
    $product->description = $validatedData['description'];
    $product->price = $validatedData['price'];

    // Generate slug from the title
    $slug = Str::slug($validatedData['name']);

    // Check if the generated slug already exists in the database
    $count = Product::where('slug', $slug)->count();
    if ($count > 0) {
        // If slug exists, append a number to make it unique
        $slug .= '-' . ($count + 1);
    }

    $product->slug = $slug; // Assign the generated slug

    $imagePaths = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/products'), $imageName);
            $imagePaths[] = 'uploads/products/' . $imageName; // Store image paths in an array
        }
    }

    $product->image = $imagePaths; // Save the array of image file paths to the database

    $product->save();

    return redirect('/admin-products')->with('message', 'New Product Added Successfully!');
}






    // public function updateProduct(Request $request)
    // {
    //     $product = Product::find($request->input("id"));
    //     if (!$product) {
    //         return redirect('/admin-products')->with('error', 'Product not found!');
    //     }

    //     $product->name = $request->input("name");
    //     $product->description = $request->input("description");
    //     $product->price = $request->input("price");

    //     // Check if a new image is uploaded
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move('uploads/products/', $imageName);
    //         $product->image = $imageName;
    //     }

    //     $product->save();
    //     return redirect('/admin-products')->with('message', 'Product Updated Successfully!');
    // }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->input("id"));
        if (!$product) {
            return redirect('/admin-products')->with('error', 'Product not found!');
        }
    
        $product->name = $request->input("name");
        $product->description = $request->input("description");
        $product->price = $request->input("price");
    
        // Check if new images are uploaded
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/products'), $imageName);
                $imagePaths[] = 'uploads/products/' . $imageName; // Store image paths in an array
            }
            $product->image = $imagePaths;
        }
    
        $product->save();
        return redirect('/admin-products')->with('message', 'Product Updated Successfully!');
    }
    
    


    public function login( Request $request ) {
       
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        try {
            $data = $request->all();
        if(Auth::guard('admin')->attempt(["email" => $data["email"], "password" => $data["password"]])){
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return back()->with("msg", "Invalid credentials");
        }
        } catch (\Throwable $th) {
            // throw $th;
            return back()->with("msg", throw $th);
        }
        
    }

    public function adminLogout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with("msg", "Logged out successfully");
    }
    
    
}
