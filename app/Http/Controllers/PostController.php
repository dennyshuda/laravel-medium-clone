<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $posts = Post::orderBy('created_at', 'asc')->paginate(10);

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
    public function store(PostCreateRequest $request) {
        $data = $request->validated();

        $image = $data['image'];
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
    public function show(string $username, Post $post) {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) {
        $categories = Category::all();
        return view('post.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post) {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')
                ->store('posts', 'public');
        }

        $data['slug'] = Str::slug($data['title']);
        $post->update($data);

        return redirect()->route('profile.lists',  auth()->user());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) {
        //
    }
}
