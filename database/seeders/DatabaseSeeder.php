<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void {

        User::factory()->create(['name' => 'test', 'email' => 'example@gmail.com']);

        $categeories = [
            'Technology',
            'Health',
            'Sport',
            'Science',
            'Politics',
            'Entertainment',
        ];

        foreach ($categeories as $categeory) {
            Category::create([
                'name' => $categeory
            ]);
        }

        Post::factory()->count(100)->create();
    }
}
