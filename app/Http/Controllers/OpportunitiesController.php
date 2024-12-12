<?php

namespace App\Http\Controllers;

use App\Models\Opportunities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OpportunitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $opportunities = Opportunities::all();

        return response()->json([
            'data' => $opportunities
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
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('opportunities', $request->file('image')->hashName());
        }

        Opportunities::create([
            'name' => $validated['name'],
            'slug' => str()->slug($validated['name']),
            'image' => $validated['image'],
            'description' => $validated['description'],
        ]);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Opportunities $opportunities)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Opportunities $opportunities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opportunities $opportunities)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($opportunities->image) {
            Storage::delete($opportunities->image);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('opportunities', $request->file('image')->hashName());
        }

        $opportunities->update([
            'name' => $validated['name'],
            'slug' => str()->slug($validated['name']),
            'image' => $validated['image'],
            'description' => $validated['description'],
        ]);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opportunities $opportunities)
    {
        if ($opportunities->image) {
            Storage::delete($opportunities->image);
        }

        $opportunities->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
