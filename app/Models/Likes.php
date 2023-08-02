<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
