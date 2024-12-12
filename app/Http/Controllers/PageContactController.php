<?php

namespace App\Http\Controllers;

use App\Models\PageContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageContact = PageContact::all();

        return response()->json([
            'data' => $pageContact
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

        if (PageContact::count() > 0) {
            return response()->json(['message' => 'data already exist'], 400);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('contacts', $request->file('banner')->hashName());
        }

        PageContact::create($validated);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageContact $pageContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageContact $pageContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageContact $pageContact)
    {
        $validated = $request->validate([
            'title' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($pageContact->banner) {
            Storage::delete($pageContact->banner);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('contacts', $request->file('banner')->hashName());
        }

        $pageContact->update($validated);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageContact $pageContact)
    {
        if ($pageContact->banner) {
            Storage::delete($pageContact->banner);
        }

        $pageContact->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
