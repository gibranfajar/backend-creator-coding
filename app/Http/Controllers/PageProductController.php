<?php

namespace App\Http\Controllers;

use App\Models\PageProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageProduct = PageProduct::all();

        return response()->json([
            'data' => $pageProduct
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
            'main_title' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if (PageProduct::count() > 0) {
            return response()->json(['message' => 'data already exist'], 400);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('products', $request->file('banner')->hashName());
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('products', $request->file('image')->hashName());
        }

        PageProduct::create($validated);

        return response()->json(['message' => 'created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageProduct $pageProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageProduct $pageProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageProduct $pageProduct)
    {
        $validated = $request->validate([
            'main_title' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if ($pageProduct->banner) {
            Storage::delete($pageProduct->banner);
        }

        if ($pageProduct->image) {
            Storage::delete($pageProduct->image);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('products', $request->file('banner')->hashName());
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('products', $request->file('image')->hashName());
        }

        PageProduct::create($validated);

        return response()->json(['message' => 'updated successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageProduct $pageProduct)
    {
        if ($pageProduct->banner && $pageProduct->image) {
            Storage::delete($pageProduct->banner);
            Storage::delete($pageProduct->image);
        }

        $pageProduct->delete();

        return response()->json(['message' => 'deleted successfully'], 200);
    }
}
