<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function create(RegisterRequest $request)
    {
        $registerData=$this->registerData($request);
        $register=User::save($registerData);
        dd($register);
        return back();
    }

    private function registerData($request)
    {
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ];
    }
}
