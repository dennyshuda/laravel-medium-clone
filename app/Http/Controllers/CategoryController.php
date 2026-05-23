<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;

class CategoryController extends Controller {
    public function category(Category $category) {
        $posts = $category->posts()->paginate(10);
        $categories = Category::all();
        $suggestedUsers = User::query()
            ->where('id', '!=', auth()->id())
            ->inRandomOrder('')
            ->take(3)
            ->get();

        return view('post.category', compact('posts', 'categories', 'suggestedUsers'));
    }
}
