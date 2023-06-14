<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SignInController extends Controller
{
    public function process(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = DB::table('users')
            ->where('email', $email)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            Session::put('email', $email);
            Session::put('user_id', $user->user_id);

            return redirect()->route('index');
        } else {
            return "Invalid email or password.";
        }
    }

    public function showSigninForm()
    {
        return view('sign_in');
    }
}
