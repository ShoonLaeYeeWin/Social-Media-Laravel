<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show()
    {
        $comments = User::join('comments', 'comments.user_id', '=', 'users.id')
        ->join('posts', 'posts.user_id', '=', 'users.id')
        ->select('users.id', 'users.name', 'users.photo', 'comments.*', 'posts.*')
        // ->where('posts.id','comments.post_id')
        ->get()->toArray();
        // dd($comments);
        return view('user.comment', compact('comments'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required',
        ]);
        $data = $this->commentData($request);
        Comment::create($data);
        return redirect()->route('comment.show');
    }

    private function commentData(Request $request)
    {
        return [
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
        ];
    }
}
