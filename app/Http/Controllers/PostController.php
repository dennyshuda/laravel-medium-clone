<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $posts = DB::table("posts")->orderBy('created_at', 'asc')->paginate(10);

        return view('post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = DB::table('categories')->get();

        return view('post.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg'],
            'title' => ['required'],
            'content' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
        ]);

        $image = $data['image'];
        unset($data['image']);
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        $imagePath = $image->store('posts', 'public');

        DB::table('posts')->insert([
            'title'        => $data['title'],
            'slug'         => $data['slug'],
            'content'      => $data['content'],
            'image'        => $imagePath,
            'category_id'  => $data['category_id'],
            'user_id'      => $data['user_id'],
            'published_at' => $data['published_at'] ?? null
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) {
        //
    }
}
