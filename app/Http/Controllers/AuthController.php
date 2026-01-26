<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register()
    {
        return view('auth.register');
    }
    public function checkRegister(Request $request)
    {
        dd($request->all());
    }
    public function login()
    {
        return view('auth.login');
    }
    public function checkLogin(Request $request)
    {
        if($request->input('username') === 'vietnh' && $request->input('password') === '1') {
            return "Login successful!";
        } else {
            return "Login failed!";
        }
    }
    public function getAge()
    {
        return view('auth.getAge');
    }
    public function checkAge(Request $request)
    {
        return response()->json([
            'message' => 'Access granted: You are old enough.',
            'age' => $request->input('age')
        ]);
    }
}