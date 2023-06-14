<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PersonalInfoController extends Controller
{
    public function showPersonalInfoForm()
    {
        return view('personal-info');
    }

    public function processPersonalInfo(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $date_of_birth = $request->input('date_of_birth');
        $quotes = $request->input('quotes');
        $social_media_links = $request->input('social_media_links');

        $image = $request->file('profile_picture');
        $imagePath = 'D:/Users/download chrome/todo_vigo1/public/upload/';
        $imageName = $image->getClientOriginalName();
        $image->move($imagePath, $imageName);

        $user_id = Session::get('user_id');

        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'address' => $address,
            'phone_number' => $phone_number,
            'date_of_birth' => $date_of_birth,
            'profile_picture' => $imageName,
            'quotes' => $quotes,
            'social_media_links' => $social_media_links,
            'user_id' => $user_id,
        ];

        DB::table('personal_information')->insert($data);

        return redirect()->route('home');
    }
}
