<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with('category_article')->with('user')->get();
        $articlesCollection = ArticleResource::collection($articles);

        return response()->json($articlesCollection, 200);
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
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_article_id' => 'required',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->storeAs('articles', $request->file('thumbnail')->hashName());
        }

        Article::create([
            'title' => $validated['title'],
            'slug' => str()->slug($validated['title']),
            'thumbnail' => $validated['thumbnail'],
            'description' => $validated['description'],
            'category_article_id' => $validated['category_article_id'],
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['message' => 'create success'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
            'category_article_id' => 'required',
        ]);

        if ($article->thumbnail) {
            Storage::delete($article->thumbnail);
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->storeAs('articles', $request->file('thumbnail')->hashName());
        }

        $article->update([
            'title' => $validated['title'],
            'slug' => str()->slug($validated['title']),
            'thumbnail' => $validated['thumbnail'],
            'description' => $validated['description'],
            'category_article_id' => $validated['category_article_id'],
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['message' => 'update success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        if ($article->thumbnail) {
            Storage::delete($article->thumbnail);
        }

        $article->delete();

        return response()->json(['message' => 'delete success'], 200);
    }
}
