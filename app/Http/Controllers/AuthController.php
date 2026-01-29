<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function signIn()
    {
        return view('auth.signIn');
    }
    public function checkSignIn(Request $request)
    {
        if($request->input('username') === 'vietnh' && $request->input('password') === $request->input('cfpassword') && $request->input('mssv') === '292867' && $request->input('class') === '67pm1' && $request->input('gender') === 'nam') {
            return "Sign In successful!";
        } else {
            return "Sign In failed!";
        }
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
        $age = $request->input('age');
        session(['age' => $age]);
        return response()->json([
            'message' => 'Access granted: You are old enough.',
            'age' => $age
        ]);
    }
}