<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $variants = ProductVariant::all();
    //     return response()->json($variants);
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     // Return a view or form for creating a new product variant
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'product_id' => 'required',
    //         'color' => 'nullable',
    //         'size' => 'nullable',
    //         'price' => 'required',
    //         'stock_quantity' => 'required',
    //     ]);

    //     $variant = ProductVariant::create($validatedData);
    //     return response()->json(['message' => 'Product variant created successfully', 'variant' => $variant], 201);
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show($id)
    // {
    //     $variant = ProductVariant::findOrFail($id);
    //     return response()->json($variant);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'product_id' => 'required',
    //         'color' => 'nullable|string|max:255',
    //         'size' => 'nullable|string|max:255',
    //         'price' => 'required|numeric',
    //         'stock_quantity' => 'required|integer',
    //     ]);

    //     $variant = ProductVariant::findOrFail($id);
    //     $variant->update($validatedData);
    //     return response()->json(['message' => 'Product variant updated successfully', 'variant' => $variant], 200);
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     $variant = ProductVariant::findOrFail($id);
    //     $variant->delete();
    //     return response()->json(['message' => 'Product variant deleted successfully'], 200);
    // }

    /**
     * Get the price of the specified variant based on color and size.
     */
    
}