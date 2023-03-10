<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show(Post $post)
    {
        $comments = Comment::join('users', 'users.id', '=', 'comments.user_id')
            ->select(['users.name', 'users.photo', 'comments.*'])
            ->where('post_id', '=', $post->id)->get();
        return view('user.showPost', compact('post', 'comments'));
    }

    public function create(CommentRequest $request, $id)
    {
        $data = $this->commentData($request);
        $post = Post::where('id', $id)->where('status', 1)->first();
        if ($post) {
            Comment::create($data);
        } else {
            abort(404);
        }
        return back();
    }

    private function commentData(CommentRequest $request)
    {
        return [
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ];
    }
}
