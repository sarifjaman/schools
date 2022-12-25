<?php

namespace App\Http\Controllers\backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentShift;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentShiftController extends Controller
{
    //Student Shift Show
    public function studentshiftshow()
    {
        $data['alldata'] = StudentShift::all();
        return view('backend.user.setup.shift.student_shift_show', $data);
    }

    //Student Shift Add
    public function studentshiftadd()
    {
        return view('backend.user.setup.shift.student_shift_add');
    }

    //Student Shift Store
    public function studentshiftstore(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:student_shifts,name'
        ]);

        $data = StudentShift::insert([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Student shift added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.show')->with($notification);
    }

    //Student Shift Edit
    public function studentshiftedit($id)
    {
        $data = StudentShift::find($id);
        return view('backend.user.setup.shift.student_shift_edit', compact('data'));
    }

    //Student Shift Update
    public function studentshiftupdate(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:student_shifts,name'
        ]);

        $data = StudentShift::find($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Student shift updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.shift.show')->with($notification);
    }

    //Student Shift Delete
    public function studentshiftdelete($id)
    {
        $data = StudentShift::find($id)->delete();

        $notification = array(
            'message' => 'Student shift deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
