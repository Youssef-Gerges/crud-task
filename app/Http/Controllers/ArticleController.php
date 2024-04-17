<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::orderBy("created_at", "desc")->paginate(10);
        return view("index", compact("articles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     */

    private function storeImage($image, $id)
    {
        $name =  Str::random() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('article_images', $name, 'public');

        $db_image = new Image();
        $db_image->path = $path;
        $db_image->article_id = $id;
        $db_image->save();
    }

    private function deleteImage($image)
    {
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }
        $image->delete();
    }
    public function store(ArticleStoreRequest $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->save();

        foreach ($request->images as $image) {
            $this->storeImage($image, $article->id);
        }

        return redirect()->route('articles.index')->with('message', 'Article has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $article->load('images');
        return view('show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $article->load('images');
        return view('edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $article->title = $request->title;
        $article->save();

        if ($request->has('images')) {
            $images = $article->images;
            foreach ($images as $image) {
                $this->deleteImage($image);
            }

            foreach ($request->images as $image) {
                $this->storeImage($image, $article->id);
            }
        }

        return redirect()->route('articles.index')->with('message', 'Article has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $images = $article->images;
        foreach ($images as $image) {
            $this->deleteImage($image);
        }

        $article->delete();
        return redirect()->route('articles.index')->with('message', 'Article has been deleted');
    }
}
