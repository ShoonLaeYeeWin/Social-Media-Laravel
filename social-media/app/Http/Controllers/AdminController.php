<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

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

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
