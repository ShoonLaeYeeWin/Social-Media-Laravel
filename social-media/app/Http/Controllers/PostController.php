<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('user.post');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:10',
            'content' => 'required',
        ]);
        $data=$this->data($request);
        $input=Post::create($data);
        // dd($input);
    }

    public function list(Request $request)
    {
        $posts=Post::all();
        // dd($posts);
        return redirect('user/show/post',compact('posts'));
    }

    public function show()
    {
        return view('user.postList');
    }

    private function data(Request $request)
    {
        return [
            'title'=>$request->title,
            'content'=>$request->content,
        ];
    }
}
