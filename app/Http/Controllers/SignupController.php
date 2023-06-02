<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

public function process(Request $request)
{
    $validator = Validator::make($request->all(), [
        'username' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Validation passed, proceed with creating the user
    $username = $request->input('username');
    $email = $request->input('email');
    $password = $request->input('password');

    // Hash the password
    $passwordHashed = Hash::make($password);

    $userId = DB::table('users')->insertGetId([
        'username' => $username,
        'email' => $email,
        'password' => $passwordHashed,
    ]);

    if ($userId) {
        Session::put('user_id', $userId);
        Session::put('username', $username);
        Session::put('email', $email);
        Session::put('logged_in', true);

        return redirect()->route('personalInfo');
    } else {
        return "Error creating user.";
    }
}
}
