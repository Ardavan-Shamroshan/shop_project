<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\CommentRequest;
use App\Models\Content\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $comments = Comment::query()->orderBy('created_at', 'desc')->where('commentable_type', 'App\Models\Content\Post')->simplePaginate(15);
        $unseenComments = Comment::query()->where('commentable_type', 'App\Models\Content\Post')->where('seen', 0)->get();
        foreach ($unseenComments as $unseenComment) {
            $unseenComment->seen = 1;
            $unseenComment->save();
        }
        return view('admin.content.comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $parenComments = Comment::query()->whereNull('paren_id');
        return view('admin.content.comment.index', compact('parenComments'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment) {
        if ($comment->seen == 0) {
            $comment->seen = 1;
            $comment->save();
            return view('admin.content.comment.show', compact('comment'));
        }
        else
            return view('admin.content.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment) {
        $parentComments = Comment::query()->whereNull('parent_id')->get()->except($comment);
        return view('admin.content.comment.edit', compact('parentComments', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment) {
        $comment->delete();
        return redirect(route('admin.content.comment'))->with('swal-success', 'نظر با موفقیت حذف شد');
    }

    public function answer(CommentRequest $request, Comment $comment) {
        if ($comment->parent == null) {
            $inputs = $request->all();
            $inputs['author_id'] = 1;
            $inputs['parent_id'] = $comment->id;
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['approved'] = 1;
            $inputs['status'] = 1;
            Comment::query()->create($inputs);
            return redirect(route('admin.content.comment'))->with('swal-success', '  پاسخ شما با موفقیت ثبت شد');
        }
        else
            return redirect(route('admin.content.comment'))->with('swal-error', 'خطا - امکان درج نظر وجود ندارد');
    }

    public function status(Comment $comment) {
        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            if ($comment->status == 0)
                return response()->json([
                    'status' => true,
                    'checked' => false,
                ]);
            else return response()->json([
                'status' => true,
                'checked' => true,
            ]);
        }
        else return response()->json([
            'status' => false,
        ]);
    }

    public function approved(Comment $comment) {
        $comment->approved = $comment->approved == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result)
            return redirect(route('admin.content.comment'))->with('toast-success', 'وضعیت نظر با موفقیت تغییر کرد');

        else
            return redirect(route('admin.content.comment'))->with('toast-error', 'تغییر وضعیت نظر با خطا مواجه شد');
    }
}
