<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $posts = Post::query()->where('status', 1)->paginate(6);
        $categories = PostCategory::query()->where('status', 1)->get();
        return view('app.content.blog.index', compact('categories', 'posts'));
    }

    public function show($slug) {
        $post = Post::query()->where('slug', '=', $slug)->firstOrFail();
        $categories = PostCategory::query()->where('status', 1)->get();
        $posts = Post::query()->where('status', 1)->get();
        $comments = $post->comments->where('status', 1)->where('approved', 1);
        return view('app.content.blog.show', compact('post', 'categories', 'posts', 'comments'));
    }
}
