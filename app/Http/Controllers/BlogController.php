<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Facades\DB; // Import DB facade if needed
use Illuminate\Http\Request; // Import the Request class

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blog = Blog::where('status', 1)
        ->with('comments')
        ->latest()
        ->paginate(10);

        // Get the query string parameters and append them to the pagination links
        $queryParameters = $request->query();
        $blog->appends($queryParameters);

        return view('blog.index', [
            'blog' => $blog
        ]);
    }

    public function show(Blog $blog)
    {   
        return view('blog.show', [
            'blog' => $blog
        ]);
    }
}
