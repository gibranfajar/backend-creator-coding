<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('categoryProduct')->get();
        $productCollection = ProductResource::collection($product);

        return response()->json([
            'data' => $productCollection
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_product_id' => 'required',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->storeAs('products', $request->file('thumbnail')->hashName());
        }

        Product::create([
            'title' => $validated['title'],
            'slug' => str()->slug($validated['title']),
            'thumbnail' => $validated['thumbnail'],
            'description' => $validated['description'],
            'category_product_id' => $validated['category_product_id']
        ]);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_product_id' => 'required',
        ]);

        if ($product->thumbnail) {
            Storage::delete($product->thumbnail);
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->storeAs('products', $request->file('thumbnail')->hashName());
        }

        $product->update([
            'title' => $validated['title'],
            'slug' => str()->slug($validated['title']),
            'thumbnail' => $validated['thumbnail'],
            'description' => $validated['description'],
            'category_product_id' => $validated['category_product_id']
        ]);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->thumbnail) {
            Storage::delete($product->thumbnail);
        }

        $product->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
