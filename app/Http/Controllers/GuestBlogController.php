<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class GuestBlogController extends Controller
{
    public function create()
    {   
        return view('user.create');
    }

    public function store()
    {
        Blog::create(array_merge($this->validateBlog(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/');
    }

    protected function validateBlog(?Blog $blog = null): array
    {
        $blog ??= new Blog();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $blog->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('blog', 'slug')->ignore($blog)],
            // 'status' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
