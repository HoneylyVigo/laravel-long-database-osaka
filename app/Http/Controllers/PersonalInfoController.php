<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class PersonalInfoController extends Controller
{
    public function showPersonalInfoForm()
    {
        return view('personal-info');
    }

    public function processPersonalInfo(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'date_of_birth' => 'required|date',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quotes' => 'nullable',
            'social_media_links' => 'nullable',
        ]);
    
        // Get form data
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $date_of_birth = $request->input('date_of_birth');
        $quotes = $request->input('quotes');
        $social_media_links = $request->input('social_media_links');
    
// Get profile picture
$profile_picture = $request->file('profile_picture');
$profile_picture_name = $profile_picture->getClientOriginalName();
$profile_picture->storeAs('', $profile_picture_name, 'images');

// Get user ID from session
$user_id = Session::get('user_id');

// Set the profile picture path
$profile_picture_path = 'images1/' . $profile_picture_name;
        
        // Save the data to the database
        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'address' => $address,
            'phone_number' => $phone_number,
            'date_of_birth' => $date_of_birth,
            'profile_picture' => $profile_picture_path,
            'quotes' => $quotes,
            'social_media_links' => $social_media_links,
            'user_id' => $user_id,
        ];
    
        DB::table('personal_information')->insert($data);
    
        return redirect()->route('home'); // Replace 'home' with the appropriate route name
    }

    
}
