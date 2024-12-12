<?php

namespace App\Http\Controllers;

use App\Models\CategoryFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = CategoryFaq::all();

        return response()->json([
            'data' => $category
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
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->storeAs('category-faqs', $request->file('icon')->hashName());
        }

        CategoryFaq::create($validated);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryFaq $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryFaq $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryFaq $category)
    {
        $validated = $request->validate([
            'title' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if ($category->icon) {
            Storage::delete($category->icon);
        }

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->storeAs('category-faqs', $request->file('icon')->hashName());
        }

        $category->update($validated);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryFaq $category)
    {
        if ($category->icon) {
            Storage::delete($category->icon);
        }

        $category->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
