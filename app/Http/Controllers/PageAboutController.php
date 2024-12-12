<?php

namespace App\Http\Controllers;

use App\Models\PageAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageAbout = PageAbout::all();

        return response()->json([
            'data' => $pageAbout
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

        if (PageAbout::count() > 0) {
            return response()->json(['message' => 'data already exist'], 400);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('abouts', $request->file('banner')->hashName());
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('abouts', $request->file('image')->hashName());
        }

        PageAbout::create($validated);

        return response()->json(['message' => 'created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageAbout $pageAbout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageAbout $pageAbout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageAbout $pageAbout)
    {
        $validated = $request->validate([
            'main_title' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if ($pageAbout->banner) {
            Storage::delete($pageAbout->banner);
        }

        if ($pageAbout->image) {
            Storage::delete($pageAbout->image);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('abouts', $request->file('banner')->hashName());
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('abouts', $request->file('image')->hashName());
        }

        PageAbout::create($validated);

        return response()->json(['message' => 'updated successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageAbout $pageAbout)
    {
        if ($pageAbout->banner && $pageAbout->image) {
            Storage::delete($pageAbout->banner);
            Storage::delete($pageAbout->image);
        }

        $pageAbout->delete();

        return response()->json(['message' => 'deleted successfully'], 200);
    }
}
