<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentGroupController extends Controller
{
    //Student Group Show
    public function studentgroupshow()
    {
        $data['alldata'] = StudentGroup::all();
        return view('backend.user.setup.group.student_group_show', $data);
    }

    //Student Group Add
    public function studentgroupadd()
    {
        return view('backend.user.setup.group.student_group_add');
    }

    //Student Group Store
    public function studentgroupstore(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:student_groups,name'
        ]);

        $data = StudentGroup::insert([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Student group added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.show')->with($notification);
    }

    //Student Group Edit
    public function studentgroupedit($id)
    {
        $data = StudentGroup::find($id);
        return view('backend.user.setup.group.student_group_edit', compact('data'));
    }

    //Student Group Store
    public function studentgroupupdate(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:student_groups,name'
        ]);

        $data = StudentGroup::find($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Student group updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.show')->with($notification);
    }

    //Student Group Delete
    public function studentgroupdelete($id)
    {
        $data = StudentGroup::find($id)->delete();

        $notification = array(
            'message' => 'Student group deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
