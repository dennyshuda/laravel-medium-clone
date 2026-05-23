<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller {
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();
        $suggestedUsers = User::query()
            ->where('id', '!=', auth()->id())
            ->inRandomOrder('')
            ->take(3)
            ->get();

        return view('home.index', [
            'posts' => $posts,
            'categories' => $categories,
            'suggestedUsers' => $suggestedUsers,
        ]);
    }
}
