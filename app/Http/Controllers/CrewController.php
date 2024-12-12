<?php

namespace App\Http\Controllers;

use App\Models\Crew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crew = Crew::all();

        return response()->json([
            'data' => $crew
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
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('profile')) {
            $validated['profile'] = $request->file('profile')->storeAs('crews', $request->file('profile')->hashName());
        }

        Crew::create($validated);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Crew $crew)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crew $crew)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crew $crew)
    {
        $validated = $request->validate([
            'name' => 'required',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($crew->profile) {
            Storage::delete($crew->profile);
        }

        if ($request->hasFile('profile')) {
            $validated['profile'] = $request->file('profile')->storeAs('crews', $request->file('profile')->hashName());
        }

        $crew->update($validated);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crew $crew)
    {
        if ($crew->profile) {
            Storage::delete($crew->profile);
        }

        $crew->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
