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
        Post::create($data);
        return back()->with(['registerSuccess' => 'Your Post Has Been Created Successfully!']);
    }

    public function list(Request $request)
    {
        $posts=Post::all();
       return view('user.postList',compact('posts'));
    }

    public function delete($id)
    {
        $postDelete=Post::find($id)->delete();
        return back()->with(['deleteSuccess' => 'Your Post Has Been Deleted Successfully!']);
    }

    public function edit($id)
    {
        $postEdit=Post::where('id',$id)->first();
        return view('user.postEdit',compact('postEdit'));
    }

    public function update($id,Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:10',
            'content' => 'required',
        ]);
        $data=$this->data($request);
        $postUpdate=Post::where('id',$request->id)->update($data);
        return redirect('/user/list/post')->with(['updateSuccess' => 'Your Post Has Been Updated Successfully!']);
    }
    private function data(Request $request)
    {
        return [
            'title'=>$request->title,
            'content'=>$request->content,
        ];
    }
}
