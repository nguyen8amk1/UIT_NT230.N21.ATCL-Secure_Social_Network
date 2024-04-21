<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credentials)) return redirect('/');
        else return view('login')->with([
            "status" => true,
            "msg" => "Invalid credentials"
        ]);
    }

    public function register(Request $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'name' => $request->input('name')
        ];
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
            'name' => 'required|string'
        ]);
        
        $user = new User($credentials);
        if ($user->save())
            return view("register")->with([
                'status' => true,
                'msg' => "Registration successful"
            ]);
        else 
            return view("register")->with([
                'status' => false,
                'msg' => "Registration failed"
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        if ($request->input("callback")) return redirect($request->input("callback"));
        return redirect('/login');
    }
}
