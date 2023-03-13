<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function create(UserRequest $request)
    {
        $data = $this->data($request);
        User::create($data);
        return redirect()->route('user.showLogin')
            ->with([
                'registerSuccess' => 'Your Account registeration is successfully!',
            ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    public function save(LoginRequest $request)
    {
        $input_data = Auth::attempt([
            'email' => $request->email, 'password' => $request->password, 'status' => '1',
        ]);
        if ($input_data) {
            return redirect()->route('user.dashboard');
        } else {
            return back()
                ->with([
                    'loginError', 'Your email and password are incorrect!',
                ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
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
            'password' => $request->password,
            'address' => $request->address,
            'photo' => $imageName,
            'dob' => $request->dob,
            'phone' => $request->phone,
        ];
    }
}
