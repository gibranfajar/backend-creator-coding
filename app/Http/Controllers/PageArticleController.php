<?php

namespace App\Http\Controllers;

use App\Models\PageArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageArticle = PageArticle::all();

        return response()->json([
            'data' => $pageArticle
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
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (PageArticle::count() > 0) {
            return response()->json(['message' => 'data already exist'], 400);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('articles', $request->file('banner')->hashName());
        }

        PageArticle::create($validated);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageArticle $pageArticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageArticle $pageArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageArticle $pageArticle)
    {
        $validated = $request->validate([
            'title' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($pageArticle->banner) {
            Storage::delete($pageArticle->banner);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('articles', $request->file('banner')->hashName());
        }

        $pageArticle->update($validated);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageArticle $pageArticle)
    {
        if ($pageArticle->banner) {
            Storage::delete($pageArticle->banner);
        }

        $pageArticle->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
