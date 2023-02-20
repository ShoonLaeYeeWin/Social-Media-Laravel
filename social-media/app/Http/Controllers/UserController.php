<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Rules\CustomEmailValidation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        $posts = DB::table('users')
        ->join('posts', 'users.id', '=', 'posts.user_id')
        ->select('users.id', 'posts.*')
        ->orderBy('posts.id', 'desc')->paginate(3);
        return view('user.dashboard',compact('posts'));
    }

    public function index()
    {
        if(Auth::user()->type == 1)
        {
            $user=Auth::user();
        }
        return view('user.profile',compact('user'));
    }

    public function edit($id)
    {
        $user=User::where('id',$id)->first();
        return view('user.profileEdit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->profileUpdateRequest($request);
        $data=$this->data($request);
        User::where('id',$id)->update($data);
        if($request->hasFile('editPhoto')){
            $imageName = uniqid().$request->file('editPhoto')->getClientOriginalName();
            $request->file('editPhoto')->storeAs('public/', $imageName);
            $data = User::find($id);

            if($data){
                $data->photo=$imageName;
            }
        }
        $data->update();
        return redirect('/user/profile')->with(['updateSuccess' => 'Your Profile Has Been Updated Successfully!']);
    }

    private function data(Request $request)
    {
        return [
            'name' => $request->editName,
            'email' => $request->editEmail,
            'Address' => $request->editAddress,
            'photo'=>$request->editPhoto,
            'dob'=>$request->editDob,
            'phone'=>$request->editPhone,
        ];
    }

    private function profileUpdateRequest($request)
    {
        $todayDate = date('m/d/Y');
        $validation= [
            'editName' => 'required',
            'editEmail' => ['required','unique:users,email,'.Auth::user()->id,new CustomEmailValidation()],
            'editAddress' => 'required',
            'editPhoto'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'editDob'=>'required|date|before:'.$todayDate,
            'editPhone' => 'required|digits:11',
        ];
        Validator::make($request->all(), $validation)->validate();
    }
} 
