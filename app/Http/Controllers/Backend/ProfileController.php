<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //Profile View
    public function profileview()
    {
        $id = Auth::user()->id;
        $profile = User::find($id);
        return view('backend.user.profile', compact('profile'));
    }

    //Edit Profile Data show
    public function profileedit()
    {
        $id = Auth::user()->id;
        $profileedit = User::find($id);
        return view('backend.user.profileedit', compact('profileedit'));
    }

    // Store Profile Data
    public function profilestore(Request $request)
    {
        $data = User::find(Auth::user()->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->mobile = $request->mobile;
        $data->gender = $request->gender;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/user_image/' . $data->image));
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/user_image'), $filename);
            $data['image'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Profile updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('profile.view')->with($notification);
    }

    //User Password Change
    public function passwordchange()
    {
        return view('backend.user.password_change');
    }

    //User Password Update
    public function updatepassword(Request $request)
    {
        // $id = Auth::user()->id;
        $validation = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedpassword = Auth::user()->password;
        // dd($hashedpassword);

        if (Hash::check($request->oldpassword, $hashedpassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification = array(
                'message' => 'User Password change successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('login')->with($notification);
        } else {
            $notification = array(
                'message' => 'User password not changed!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
