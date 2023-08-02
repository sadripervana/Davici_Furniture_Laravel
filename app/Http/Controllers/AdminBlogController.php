<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    public function index()
    {
        return view('admin.blog.index', [
            'blog' => Blog::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store()
    {
        Blog::create(array_merge($this->validateBlog(), [
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]));

        return redirect('/');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', ['blog' => $blog]);
    }

    public function update(Blog $blog)
    {   
        if(request()->input('status')){
            // Validate only the status field without validating other attributes
            request()->validate([
                'status' => 'required|in:0,1', // Validate that status can only be 0 or 1
            ]);

            $status = request()->input('status');

            $blog->update([
                'status' => $status,
            ]);

            return back()->with('success', 'Blog Aproved!');
        } else {
            $attributes = $this->validateBlog($blog);

            if ($attributes['thumbnail'] ?? false) {
                $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
            }

            $blog->update($attributes);

            return back()->with('success', 'Blog Updated!');
        }
        
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return back()->with('success', 'Blog Deleted!');
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
