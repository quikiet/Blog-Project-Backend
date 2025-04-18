<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class posts extends Model
{
    /** @use HasFactory<\Database\Factories\PostsFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'summary',
        'thumbnail',
        'status',
        'published_at',
        'category_id',
        'user_id',
        'author_id'
    ];

    public function posts_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post_likes()
    {
        return $this->hasMany(post_likes::class);
    }

    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }

    public function post_tag()
    {
        return $this->hasMany(post_tag::class);
    }

    public function posts_comments()
    {
        return $this->hasMany(comments::class);
    }

    public function tags()
    {
        return $this->belongsToMany(tags::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function authors()
    {
        return $this->belongsTo(authors::class, 'author_id', 'id');
    }

    public function refuses()
    {
        return $this->hasMany(refuses::class, 'post_id');
    }

    public function postViews()
    {
        return $this->hasMany(post_views::class, 'post_id', 'id');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

}
