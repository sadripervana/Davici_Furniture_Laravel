<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Post;
use App\Models\Likes;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


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
        } elseif ($hot == 'best') {
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

        $totalCart = Cart::where('user_id', auth()->id())->count();
        $totalLikes = Likes::where('user_id', auth()->id())->count();

        $random = rand(0, 7);

        return view('posts.index', [
            'posts' => $posts,
            'totalPosts' => $totalPosts,
            'totalLikes' => $totalLikes,
            'totalcart' => $totalCart,
            'blog' => $blog,
            'random' => $random
        ]);
    }


    public function show(Post $post)
    {
        $averageRating = $post->ratings()->avg('rating');

        $user = Auth::user();
        $existingLike = null;
        if ($user) {
            $existingLike = Likes::where('user_id', $user->id)
                ->where('post_id', $post->id)
                ->first();
        }

        return view('posts.show', [
            'post' => $post,
            'averageRating' => $averageRating,
            'random' => rand(0, 7),
            'existingLike' => $existingLike
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

    public function likes(Request $request, $id)
    {
        try {
            $user = $request->user();

            // Check if the user has already liked the post
            $existingLike = Likes::where('user_id', $user->id)
                ->where('post_id', $id)
                ->first();

            if ($existingLike) {
                // If the user has already liked the post, delete the like record
                $existingLike->delete();

                // Return a JSON response indicating that the post is unliked
                return response()->json(['likes' => 0, 'message' => 'Post unliked successfully.']);
            }

            // If the user has not liked the post, create a new like record
            $attributes = [
                'post_id' => $id,
                'user_id' => $user->id,
                'likes' => 1,
            ];

            Likes::create($attributes);

            // Return a JSON response with the updated likes count and success message
            return response()->json(['likes' => 1, 'message' => 'Post liked successfully.']);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Likes method error: ' . $e->getMessage());

            // Return a JSON response with an error message
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }
}
