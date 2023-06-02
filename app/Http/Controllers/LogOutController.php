<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    public function logout()
    {
        Auth::logout(); // Unset all authenticated user session variables
        
        return redirect()->route('signin'); // Replace 'signin' with the appropriate route name for your login page
    }
}
