<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\Blog;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $hot = $request->input('hot');

        if ($hot === 'top') {
            // If hot parameter is 'top', get posts ordered by highest average rating
            $posts = Post::select('posts.*', DB::raw('COALESCE(AVG(ratings.rating), 0) as averageRating'))
            ->leftJoin('ratings', 'posts.id', '=', 'ratings.post_id')
            ->groupBy('posts.id')
            ->orderBy('averageRating', 'desc')
                ->paginate(8)
                ->withQueryString();
        } elseif($hot == 'best') {
            // If hot parameter is 'best', get posts with most sold products
            $posts = Post::select('posts.*')
                ->orderBy('sold', 'desc')
                ->paginate(8)
                ->withQueryString();
        } else {
            // Default behavior: Get posts ordered by the latest
            $posts = Post::latest()
                ->filter(request(['search', 'category', 'author']))
                ->paginate(8)
                ->withQueryString();
        }
        
        $blog = Blog::where('status', 1)
        ->with('comments')
        ->latest()
        ->paginate(10);
        $queryParameters = $request->query();
        $blog->appends($queryParameters);

        $totalPosts = Post::count();

        return view('posts.index', [
            'posts' => $posts,
            'totalPosts' => $totalPosts,
            'blog' => $blog,
            'random' => rand(0,7)
        ]);
    }


    public function show(Post $post)
    {
        $averageRating = $post->ratings()->avg('rating');
        return view('posts.show', [
            'post' => $post,
            'averageRating' => $averageRating,
        ]);
    }

    public function rate(Request $request, $id)
    {   
        // Retrieve the authenticated user
        $user = $request->user();

        // Retrieve the post
        $post = Post::findOrFail($id);

        // Check if the user has already rated for the given post
        $existingRating = $post->ratings()
            ->where('user_id', $user->id)
            ->first();

        if ($existingRating) {
            // User has already rated, update the existing rating
            $existingRating->rating = $request->input('rating');
            $existingRating->save();

            return redirect()->back()->with('success', 'Rating updated successfully.');
        }

        // Continue with rating submission if user hasn't rated

        $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
        ]);

        $rating = new Rating([
            'user_id' => $user->id,
            'rating' => $request->input('rating'),
        ]);

        $post->ratings()->save($rating);

        return redirect()->back()->with('success', 'Rating submitted successfully.');
    }
}
