<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    # A post belongs to a user
    # Use this method to get he owner of the post
    # One-To-Many (Inverse Relationship)
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    # One-To-Many method (relationship)
    # Use this method to get the categories under the post
    public function categoryPost()
    {
        return $this->hasMany(CategoryPost::class);
    }

    # To get all the comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    # One-To-Many method (relationship)
    # Use this method to get the likes of the post
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    # Is the post liked already?
    # This method will return TRUE if the post is already liked.
    public function isLiked() // Example: John Smith - 1(id) ---TRUE(Already liked)
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}
