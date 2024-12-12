<?php

namespace App\Http\Controllers;

use App\Models\PageHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageHome = PageHome::all();

        return response()->json([
            'data' => $pageHome
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

        if (PageHome::count() > 0) {
            return response()->json(['message' => 'data already exist'], 400);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('homes', $request->file('banner')->hashName());
        }

        PageHome::create($validated);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageHome $pageHome)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageHome $pageHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageHome $pageHome)
    {
        $validated = $request->validate([
            'title' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($pageHome->banner) {
            Storage::delete($pageHome->banner);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('homes', $request->file('banner')->hashName());
        }

        $pageHome->update($validated);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageHome $pageHome)
    {
        if ($pageHome->banner) {
            Storage::delete($pageHome->banner);
        }

        $pageHome->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
