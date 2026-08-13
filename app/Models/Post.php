<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'image', 'author_id', 'status', 'views', 'is_highlight', 'published_at'];

    protected $casts = [
        'is_highlight' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
