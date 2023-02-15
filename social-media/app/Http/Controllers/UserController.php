<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.profile');
    }

    public function create(UserRequest $request)
    {
        $data = $this->data($request);
        $input = User::create($data);
        return back()->with(['registerSuccess' => 'Your Account registeration is successfully!']);
    }

    public function show(){
        $users=User::all();
        // dd($users);
        return view('user.profileList',compact('users'));
    }
    private function data($request)
    {
        $imageName = uniqid().'_image.'.$request->photo->extension();  
        $request->photo->storeAs('images', $imageName);
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'photo'=>$imageName,
            'dob'=>$request->dob,
            'phone'=>$request->phone,
        ];
    }
}
