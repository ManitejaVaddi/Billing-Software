<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        // Retrieve all products
        $products = Product::all();

        // Pass products data to the view
        return view('products.index', compact('products'));
    }

    // Show form to create a new product
    public function create()
    {
        // Return the product creation view
        return view('products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        // Validate input data, including the 'stock' field
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer', // Ensure stock is required and an integer
        ]);

        // Create a new product, using only the allowed fields
        Product::create($request->only('name', 'description', 'price', 'stock')); // Only accept these fields

        // Redirect to the products page with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show form to edit a product
    public function edit(Product $product)
    {
        // Return the edit product view, passing the product data
        return view('products.edit', compact('product'));
    }

    // Update the product
    public function update(Request $request, Product $product)
    {
        // Validate input data, including the 'stock' field
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer', // Ensure stock is required and an integer
        ]);

        // Update the product with only the allowed fields
        $product->update($request->only('name', 'description', 'price', 'stock')); // Only accept these fields

        // Redirect to the products page with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete the product
    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();

        // Redirect to the products page with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
