<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Post;
use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $likes = Likes::where('user_id', $user->id)->get();

        $totalPrice = 0;
        $i = 0;

        foreach ($likes as $like) {
            $post[] = Post::find($like->post_id); // Assuming 'post_id' is the foreign key linking likes to posts
            if ($post) {
                // Assuming 'price' is the column in the 'posts' table representing the price of a post
                $totalPrice += $post[$i]->price; // Assuming 'quantity' is the column representing the quantity in the cart
            }
            $i++;
        }

        if (isset($post)) {

            $likesPost = $likes->zip($post);
        } else {
            $likesPost = [];
        }


        return view('likes.show', [
            'likes' => $likesPost,
            'totalPrice' => $totalPrice
        ]);
    }

    public function destroy(Likes $like)
    {
        // dd($likes);
        $like->delete();

        return back()->with('error', 'Product removed from likes!');
    }
}
