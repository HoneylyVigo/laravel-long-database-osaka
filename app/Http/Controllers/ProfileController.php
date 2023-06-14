<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

        $personal_info = DB::table('personal_information')->where('user_id', $id)->first();

        if (!$personal_info) {
            return redirect()->back();
        }


        if ($request->hasFile('profile_picture')) {
            $newImage = $request->file('profile_picture');
            $newImage->move(public_path('upload'), $newImage->getClientOriginalName());

            DB::table('personal_information')->where('user_id', $id)->update(['profile_picture' => $newImage->getClientOriginalName()]);
        }

        DB::table('personal_information')
            ->where('user_id', $id)
            ->update([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'address' => $validatedData['address'],
                'phone_number' => $validatedData['phone_number'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'quotes' => $validatedData['quotes'],
                'social_media_links' => $validatedData['social_media_links'],
            ]);

        return redirect()->route('profile');
    }
    public function edit($id)
    {
        $personal_info = DB::table('personal_information')->where('user_id', $id)->first();

        if (!$personal_info) {
            return redirect()->back();
        }

        return view('edit-profile', ['personal_info' => $personal_info]);
    }
}
