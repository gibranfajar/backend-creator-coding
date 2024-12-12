<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobForYouResource;
use App\Models\JFY;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JFYController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jFY = JFY::with('opportunity')->get();
        $jFYCollection = JobForYouResource::collection($jFY);

        return response()->json([
            'data' => $jFYCollection
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'requirement' => 'required',
            'description' => 'required',
            'opportunity_id' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('jfy', $request->file('image')->hashName());
        }

        JFY::create([
            'title' => $validated['title'],
            'slug' => str()->slug($validated['title']),
            'image' => $validated['image'],
            'requirement' => $validated['requirement'],
            'description' => $validated['description'],
            'opportunity_id' => $validated['opportunity_id']
        ]);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(JFY $jFY)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JFY $jFY)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JFY $jFY)
    {
        $validated = $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'requirement' => 'required',
            'description' => 'required',
            'opportunity_id' => 'required'
        ]);

        if ($jFY->image) {
            Storage::delete($jFY->image);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('jfy', $request->file('image')->hashName());
        }

        $jFY->update([
            'title' => $validated['title'],
            'slug' => str()->slug($validated['title']),
            'image' => $validated['image'],
            'requirement' => $validated['requirement'],
            'description' => $validated['description'],
            'opportunity_id' => $validated['opportunity_id']
        ]);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JFY $jFY)
    {
        if ($jFY->image) {
            Storage::delete($jFY->image);
        }

        $jFY->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
