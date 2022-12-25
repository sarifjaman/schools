<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Show user list
    public function userview()
    {
        // $showdata = User::all();
        $showdata = User::where('usertype', 'Admin')->get();
        return view('backend.user.user_show', compact('showdata'));
    }

    //Add User
    public function adduser()
    {
        return view('backend.user.add_user');
    }

    //Store User
    public function storeuser(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
        ]);

        $user = new User();

        $code = rand(0000, 9999);
        $user->code = $code;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($code);
        $user->usertype = 'Admin';
        $user->save();

        $notification = array(
            'message' => 'User added successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('user.view')->with($notification);
    }

    //Edit User
    public function edituser($id)
    {
        $edituser = User::findOrFail($id);
        return view('backend.user.edit_user', compact('edituser'));
    }

    //Update User
    public function updateuser(Request $request, $id)
    {

        // dd($request->role);

        // $updateuser = User::findOrFail($id)->update([
        //     'name' => $request->name,
        //     'role' => $request->role,
        //     'email' => $request->email,
        // ]);

        $updateuser = User::findOrFail($id);

        $updateuser->name = $request->name;
        $updateuser->role = $request->role;
        $updateuser->email = $request->email;
        $updateuser->save();

        $notification = array(
            'message' => 'User updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    //Delete User
    public function deleteuser($id)
    {
        $deleteuser = User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'User deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.view')->with($notification);
    }
}
