<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    
    public function login(LoginRequest $request)
    {
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        $user_data = array(
            $fieldType => $request->email,
            'password'  => $request->password,
        );
        $input_data = Auth::attempt($user_data);
        if ($input_data) {
            if (Auth::user()->type == 0) {
                return redirect('/admin/dashboard');
            }
        } else {
            return back()->with('loginError', 'Your email and password are incorrect!');
        }
    }

    public function view()
    {
        return view('admin.dashboard');
    }

    public function show()
    {
        if(Auth::user()->type == 0)
        {
            $user=Auth::user();
        }
        return view('admin.profile',compact('user'));
    }

    public function edit()
    {
        if(Auth::user()->type == 0)
        {
            $user=Auth::user();
        }
        // $id=$user->id;
        // // dd($id);
        return view('admin.profileEdit',compact('user'));
    }

    public function upgrade($id,Request $request)
    {
        if(Auth::user()->type == 0)
        {
            $user=Auth::user();
        }
        // $data=$this->data($request);
        $input=User::where('id',$user->id)->get();
        dd($input);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    private function data($request)
    {
        // $imageName = uniqid().'_image.'.$request->photo->extension();  
        // $request->photo->storeAs('images', $imageName);
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            // 'photo'=>$imageName,
            'dob'=>$request->dob,
            'phone'=>$request->phone,
        ];
    }
}
