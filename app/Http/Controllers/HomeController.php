<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller {
    public function index() {
        $posts = Post::orderBy('created_at', 'asc')->paginate(10);

        return view('home.index', [
            'posts' => $posts
        ]);
    }
}
