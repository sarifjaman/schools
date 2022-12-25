<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    //Designation Show
    public function designationshow()
    {
        $data['alldata'] = Designation::all();
        return view('backend.user.setup.designation.designation', $data);
    }

    //Designation Add
    public function designationadd()
    {
        return view('backend.user.setup.designation.designation_add');
    }

    //Designation Store
    public function designationstore(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|unique:designations,name'
        ]);

        $data = Designation::insert([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Designation added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.show')->with($notification);
    }

    //Designation Edit
    public function designationedit($id)
    {
        $editdata = Designation::find($id);
        return view('backend.user.setup.designation.designation_edit', compact('editdata'));
    }

    //Designation Update
    public function designationupdate(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|unique:designations,name'
        ]);

        $data = Designation::find($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Designation updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.show')->with($notification);
    }

    //Designation Delete
    public function designationdelete($id)
    {
        $data = Designation::find($id)->delete();

        $notification = array(
            'message' => 'Designation deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.show')->with($notification);
    }
}
