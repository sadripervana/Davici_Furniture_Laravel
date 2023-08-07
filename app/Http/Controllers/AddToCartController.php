<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $carts = Cart::where('user_id', $user->id)->get();

        $totalPrice = 0;
        $i = 0;

        foreach ($carts as $cart) {
            $post[] = Post::find($cart->post_id); // Assuming 'post_id' is the foreign key linking carts to posts
            if ($post) {
                // Assuming 'price' is the column in the 'posts' table representing the price of a post
                $totalPrice += $post[$i]->price * $cart->quantity; // Assuming 'quantity' is the column representing the quantity in the cart
            }
            $i++;
        }

        if (isset($post)) {

            $cartPost = $carts->zip($post);
        } else {
            $cartPost = [];
        }


        return view('cart.show', [
            'carts' => $cartPost,
            'totalPrice' => $totalPrice
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $attributes = [
            'post_id' => $request->input('post'),
            'user_id' => $user->id,
            'color' => $request->input('color'),
            'size' => $request->input('size'),
            'quantity' => $request->input('quantity'),
        ];

        Cart::create($attributes);

        return redirect()->back()->with('success', 'Added to cart successfully.');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return back()->with('error', 'Product removed from cart!');
    }
}
