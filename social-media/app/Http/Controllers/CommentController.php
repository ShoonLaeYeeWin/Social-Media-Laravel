<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function show(Post $post)
    {
        $comments = Comment::where('post_id', '=', $post->id)->get();
        return view('user.showPost', compact('post', 'comments'));
    }

    public function create(CommentRequest $request)
    {
        $data = $this->commentData($request);
        Comment::create($data);
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
