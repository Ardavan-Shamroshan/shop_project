<?php
//
//namespace App\Http\Controllers;
//
//use App\Http\Requests\SearchRequest;
//use App\Models\Content\Post;
//use App\Models\Content\PostCategory;
//use App\Models\Content\Service;
//use App\Models\Content\Slide;
//
//class HomeController extends Controller {
//    public function index() {
//        $slides = Slide::query()->where('status', 1)->get();
//        $services = Service::query()->where('status', 1)->get();
//        $posts = Post::query()->where('status', 1)->get();
//        $categories = PostCategory::query()->where('status', 1)->get();
//        return view('app.index', compact('slides', 'services', 'posts', 'categories'));
//    }
//
//    public function about() {
//        return view('app.about-us');
//    }
//    public function gallery() {
//        $posts = Post::query()->where('status', 1)->get();
//        $postCategories = PostCategory::query()->where('status', 1)->get();
//        return view('app.gallery', compact('posts', 'postCategories'));
//    }
//
//
//    public function search(SearchRequest $request) {
//        // Get the search value from the request
//        $search = $request->input('search');
//        // Search in the title and body columns from the posts table
//        $posts = Post::query()
//            ->where('title', 'LIKE', "%{$search}%")
//            ->orWhere('body', 'LIKE', "%{$search}%")
//            ->paginate(6);
//        // Return the search view with the results compacted
//        return view('app.search', compact('posts', 'search'));
//    }
//}
