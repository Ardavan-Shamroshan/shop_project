<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug) {
        $category = PostCategory::query()->where('slug', '=', $slug)->firstOrFail();
        $categories = PostCategory::query()->where('status', 1)->get();
        $posts = Post::query()->where('category_id', $category->id)->paginate(6);
        $allPosts = Post::query()->where('status', 1)->get();
        return view('app.content.category.index', compact('posts', 'category', 'categories', 'allPosts'));
    }
}
