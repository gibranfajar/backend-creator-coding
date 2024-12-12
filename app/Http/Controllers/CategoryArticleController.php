<?php

namespace App\Http\Controllers;

use App\Models\CategoryArticle;
use Illuminate\Http\Request;

class CategoryArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = CategoryArticle::all();

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
        ]);

        CategoryArticle::create($validated);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryArticle $categoryACategoryArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryArticle $categoryACategoryArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryArticle $categoryACategoryArticle)
    {
        $validated = $request->validate([
            'title' => 'required',
        ]);

        $categoryACategoryArticle->update($validated);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryArticle $categoryACategoryArticle)
    {
        $categoryACategoryArticle->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
