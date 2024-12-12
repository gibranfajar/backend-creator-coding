<?php

namespace App\Http\Controllers;

use App\Models\PageCareer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageCareerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageCareer = PageCareer::all();

        return response()->json([
            'data' => $pageCareer
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

        if (PageCareer::count() > 0) {
            return response()->json(['message' => 'data already exist'], 400);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('careers', $request->file('banner')->hashName());
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('careers', $request->file('image')->hashName());
        }

        PageCareer::create($validated);

        return response()->json(['message' => 'created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageCareer $pageCareer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageCareer $pageCareer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageCareer $pageCareer)
    {
        $validated = $request->validate([
            'main_title' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        if ($pageCareer->banner) {
            Storage::delete($pageCareer->banner);
        }

        if ($pageCareer->image) {
            Storage::delete($pageCareer->image);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('careers', $request->file('banner')->hashName());
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('careers', $request->file('image')->hashName());
        }

        PageCareer::create($validated);

        return response()->json(['message' => 'updated successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageCareer $pageCareer)
    {
        if ($pageCareer->banner && $pageCareer->image) {
            Storage::delete($pageCareer->banner);
            Storage::delete($pageCareer->image);
        }

        $pageCareer->delete();

        return response()->json(['message' => 'deleted successfully'], 200);
    }
}
