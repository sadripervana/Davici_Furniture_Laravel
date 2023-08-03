<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {
        $validatedData = $this->validatePost();

        // Save the selected colors as a comma-separated string
        $selectedColors = implode(',', request()->input('color', []));
        $validatedData['color'] = $selectedColors;
        $selectedSize = implode(',', request()->input('size', []));
        $validatedData['size'] = $selectedSize;

        $validatedData['user_id'] = request()->user()->id;
        $validatedData['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($validatedData);

        return redirect('/');
    }


    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);

        // Save the selected colors as a comma-separated string
        $selectedColors = implode(',', request()->input('color', []));
        $attributes['color'] = $selectedColors;

        $selectedSize = implode(',', request()->input('size', []));
        $attributes['size'] = $selectedSize;

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('error', 'Post Deleted!');
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();

        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post)],
            'price' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}
