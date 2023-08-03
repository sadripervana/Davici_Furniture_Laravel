<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class VariableController extends Controller
{
    // Other methods...

    public function getRandom()
    {
        $random = rand(0,7);
        $post = Post::latest()
            ->filter(request(['search', 'category', 'author']))
            ->paginate(8)
            ->withQueryString();
        return response()->json(
            ['random' => $random,
            'post'=>$post]
        );
    }
}
