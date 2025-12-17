<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller {
    public function category(Category $category) {
        $posts = $category->posts()->paginate(10);
        return view('post.category', compact('posts'));
    }
}
