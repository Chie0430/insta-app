<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public $timestamps = false; // we don't want to use $timestamps here

    # Use this method to get info of the user
    public function follower()
    {
        // return $this->belongsTo(User::class, 'follower_id')->withTrashed();
        return $this->belongsTo(User::class)->withTrashed();
    }

    # Use this method to get info of the user being followed
    public function following()
    {
        // return $this->belongsTo(User::class, 'following_id')->withTrashed();
        return $this->belongsTo(User::class)->withTrashed();
    }
}
