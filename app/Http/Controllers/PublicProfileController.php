<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicProfileController extends Controller {
    public function show(User $user) {
        $posts = $user->posts()->latest()->paginate(10);

        return view('profile.show', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function about(User $user) {
        return view('profile.about', [
            'user' => $user,
        ]);
    }

    public function lists(User $user) {
        $posts = $user->posts()->latest()->paginate(10);

        return view('profile.lists', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}
