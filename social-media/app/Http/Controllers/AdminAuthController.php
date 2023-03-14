<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

/**
 * This is AdminAuth Controller.
 */
class AdminAuthController extends Controller
{
    /**
     * Admin Show Login
     *
     * @return view
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * Admin Action Login
     *
     *@param LoginRequest $request
     *
     *@return back with loginError
     */
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

    /**
     *Admin logout
     *
     *@param Request $request
     *
     *@return redirect
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('view');
    }
}
