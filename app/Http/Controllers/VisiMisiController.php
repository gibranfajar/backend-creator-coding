<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visiMisi = VisiMisi::all();

        return response()->json([
            'data' => $visiMisi
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_visi' => 'required',
            'description_visi' => 'required',
            'title_misi' => 'required',
            'description_misi' => 'required',
        ]);

        if (VisiMisi::count() > 0) {
            return response()->json([
                'message' => 'data already exist'
            ], 400);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('visimisi', $request->file('image')->hashName());
        }

        VisiMisi::create($validated);

        return response()->json([
            'message' => 'Visi Misi created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisiMisi $visiMisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisiMisi $visiMisi)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_visi' => 'required',
            'description_visi' => 'required',
            'title_misi' => 'required',
            'description_misi' => 'required',
        ]);

        if ($visiMisi->image) {
            Storage::delete($visiMisi->image);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->storeAs('visimisi', $request->file('image')->hashName());
        }

        $visiMisi->update($validated);

        return response()->json([
            'message' => 'Visi Misi updated successfully'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisiMisi $visiMisi)
    {
        if ($visiMisi->image) {
            Storage::delete($visiMisi->image);
        }

        $visiMisi->delete();

        return response()->json([
            'message' => 'Visi Misi deleted successfully'
        ], 200);
    }
}
