<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = Post::published()
            ->with('categories')
            ->latest('published_at')
            ->paginate(9);

        return view('blog.index', ['posts' => $posts]);
    }

    public function show(Post $post): View
    {
        abort_unless($post->status === 'published' && (! $post->published_at || $post->published_at->isPast()), 404);

        $post->load('categories');

        return view('blog.show', ['post' => $post]);
    }
}
