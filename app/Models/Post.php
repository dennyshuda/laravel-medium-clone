<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'slug',
        'image',
        'user_id',
        'published_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function readTime($wordsPerminute = 100) {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / $wordsPerminute);

        return max(1, $minutes);
    }
}
