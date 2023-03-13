<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        $input_data = Auth::guard('admin')
                            ->attempt([
                                'email' => $request->email, 'password' => $request->password
                            ]);
        if ($input_data) {
            return redirect()->route('admin.dashboard');
        } else {
            return back()
                ->with([
                    'loginError', 'Your email and password are incorrect!'
                ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
