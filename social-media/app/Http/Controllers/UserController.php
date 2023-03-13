<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Rules\CustomEmailValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        $posts = User::join('posts', 'posts.user_id', '=', 'users.id')
                    ->select(['users.id', 'users.name', 'users.photo', 'posts.*',])
                    ->orderBy('posts.id', 'desc')->paginate(9);
        $userCount = User::all()->count();
        return view('user.dashboard', compact('posts', 'userCount'));
    }

    public function index()
    {
        $userCount = User::all()->count();
        return view('user.profile', compact('userCount'));
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $userCount = User::all()->count();
        return view('user.profileEdit', compact('user', 'userCount'));
    }

    public function update(UserProfileRequest $request, $id)
    {
        $data = [
            'name' => $request->editName,
            'email' => $request->editEmail,
            'Address' => $request->editAddress,
            'dob' => $request->editDob,
            'phone' => $request->editPhone,
        ];
        if ($request->hasFile('editPhoto')) {
            $imageName = uniqid() . $request->file('editPhoto')->getClientOriginalName();
            $request->file('editPhoto')->storeAs('public/', $imageName);
            $data['photo'] = $imageName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('user.profile')
            ->with([
                'updateSuccess' => 'Your Profile Has Been Updated Successfully!'
            ]);
    }

    public function createPost(PostRequest $request)
    {
        $data = $this->postData($request);
        Post::create($data);
        return back();
    }

    private function postData($request)
    {
        return [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ];
    }
}
