<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginAPI(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return response()->json(['redirect' => route('home.web.get')]);
        }
        return response()->json(['error' => 'Failed to Login'], 422);
    }

    public function register()
    {
        return view('registration');
    }

    public function registerAPI(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'passwordConfirmation' => 'required|same:password',

        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if (!$user) {
            return response()->json(['error' => 'Failed to Register'], 422);
        }

        return response()->json(['redirect' => route('login.web.get')]);
    }

    public function logoutAPI() {
        Session::flush();
        Auth::logout();
        return response()->json(['redirect' => route('login.web.get')]);
    }
}
