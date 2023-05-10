<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use App\Models\Content\Post;
use App\Models\Content\PostCategory;
use App\Models\Notify\Email;
use App\Models\Notify\SMS;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller {
    public function index() {
        $postsCount = Post::query()->count();
        $postCategoriesCount = PostCategory::query()->count();
        $commentsCount = Comment::query()->count();
        $adminsCount = User::query()->where('user_type', 1)->count();
        // dd($adminsCount);
        $usersCount = User::query()->count();
        $ticketsCount = Ticket::query()->count();
        $emailsCount = Email::query()->count();
        $smsCount = SMS::query()->count();
        return view('admin.index', compact(
            'postsCount',
            'postCategoriesCount',
            'commentsCount',
            'adminsCount',
            'usersCount',
            'ticketsCount',
            'emailsCount',
            'smsCount',
        ));
    }


}
