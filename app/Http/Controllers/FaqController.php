<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqResource;
use App\Models\CategoryFaq;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faq = Faq::with('categoryFaq')->get();
        $faqCollection = FaqResource::collection($faq);

        return response()->json([
            'data' => $faqCollection
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
            'description' => 'required',
            'category_faq_id' => 'required',
        ]);

        Faq::create($validated);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_faq_id' => 'required',
        ]);

        $faq->update($validated);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
