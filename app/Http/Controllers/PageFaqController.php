<?php

namespace App\Http\Controllers;

use App\Models\PageFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageFaq = PageFaq::all();

        return response()->json([
            'data' => $pageFaq
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

        if (PageFaq::count() > 0) {
            return response()->json(['message' => 'data already exist'], 400);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('faqs', $request->file('banner')->hashName());
        }

        PageFaq::create($validated);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(PageFaq $pageFaq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageFaq $pageFaq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PageFaq $pageFaq)
    {
        $validated = $request->validate([
            'title' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($pageFaq->banner) {
            Storage::delete($pageFaq->banner);
        }

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->storeAs('faqs', $request->file('banner')->hashName());
        }

        $pageFaq->update($validated);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageFaq $pageFaq)
    {
        if ($pageFaq->banner) {
            Storage::delete($pageFaq->banner);
        }

        $pageFaq->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
