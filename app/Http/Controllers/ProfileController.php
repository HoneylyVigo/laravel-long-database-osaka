<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user_id = Session::get('user_id');
        $personal_info = DB::table('personal_information')->where('user_id', $user_id)->first();
    
        return view('profile', compact('personal_info'));
    }

    public function update(Request $request, $id)
{
    // Validate the form data
    $validatedData = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'address' => 'required',
        'phone_number' => 'required',
        'date_of_birth' => 'required',
        'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'quotes' => 'required',
        'social_media_links' => 'nullable',
    ]);

    // Retrieve the personal information based on the user_id
    $personal_info = DB::table('personal_information')->where('user_id', $id)->first();

    if (!$personal_info) {
        // Personal information not found, handle accordingly (e.g., redirect, error message)
        return redirect()->back();
    }

    // Update the personal information fields
    $profile_picture = $personal_info->profile_picture;
    if ($request->hasFile('profile_picture')) {
        $file = $request->file('profile_picture');
        $profile_picture_name = $file->getClientOriginalName();
        $file->storeAs('image', $profile_picture_name, 'public');
        $profile_picture = $profile_picture_name;
    }

    DB::table('personal_information')
        ->where('user_id', $id)
        ->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'profile_picture' => $profile_picture,
            'quotes' => $validatedData['quotes'],
            'social_media_links' => $validatedData['social_media_links'],
        ]);

    // Redirect to the profile page after the update
    return redirect()->route('profile');
}
public function edit($id)
{
    // Retrieve the personal information based on the user_id
    $personal_info = DB::table('personal_information')->where('user_id', $id)->first();

    if (!$personal_info) {
        // Personal information not found, handle accordingly (e.g., redirect, error message)
        return redirect()->back();
    }

    return view('edit-profile', ['personal_info' => $personal_info]);
}
    
}
