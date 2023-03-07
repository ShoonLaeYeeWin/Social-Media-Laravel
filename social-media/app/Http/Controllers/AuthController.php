<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function create(UserRequest $request)
    {
        $data = $this->data($request);
        User::create($data);
        return redirect('/auth/login')->with(['registerSuccess' => 'Your Account registeration is successfully!']);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function save(LoginRequest $request)
    {
        $input_data = Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($input_data) {
            return redirect('/user/dashboard');
        } else {
            return back()->with('loginError', 'Your email and password are incorrect!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function data($request)
    {
        $imageName = uniqid() . '_image.' . $request->photo->extension();
        $request->photo->storeAs('public/', $imageName);
        return [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'photo' => $imageName,
            'dob' => $request->dob,
            'phone' => $request->phone,
        ];
    }
}
