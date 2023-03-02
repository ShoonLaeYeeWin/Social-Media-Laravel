<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Rules\CustomEmailValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileUpdateRequest;

class UserController extends Controller
{
    public function dashboard()
    {
        $posts = User::join('posts', 'posts.user_id', '=', 'users.id')
        ->select(['users.id','users.name','users.photo', 'posts.*',])
        ->orderBy('posts.id', 'desc')->paginate(9);
        return view('user.dashboard', compact('posts'));
    }

    public function index()
    {
        if (Auth::user()->type == 1) {
            $user = Auth::user();
        }
        return view('user.profile', compact('user'));
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('user.profileEdit', compact('user'));
    }

    public function update(ProfileUpdateRequest $request, $id)
    {
        $data = $this->data($request);
        User::where('id', $id)->update($data);
        if ($request->hasFile('editPhoto')) {
            $imageName = uniqid() . $request->file('editPhoto')->getClientOriginalName();
            $request->file('editPhoto')->storeAs('public/', $imageName);
            $data = User::find($id);

            if ($data) {
                $data->photo = $imageName;
            }
        }
        $data->update();
        return redirect('/user/profile')->with(['updateSuccess' => 'Your Profile Has Been Updated Successfully!']);
    }

    private function data($request)
    {
        return [
            'name' => $request->editName,
            'email' => $request->editEmail,
            'Address' => $request->editAddress,
            'photo' => $request->editPhoto,
            'dob' => $request->editDob,
            'phone' => $request->editPhone,
        ];
    }
}
