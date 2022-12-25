<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentYearController extends Controller
{
    //Student Year View
    public function studentyearview()
    {
        $data['alldata'] = StudentYear::all();
        return view('backend.user.setup.year.student_year_view', $data);
    }

    //Student Year Add
    public function studentyearadd()
    {
        return view('backend.user.setup.year.student_year_add');
    }

    //Student Year Store
    public function studentyearstore(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);

        $data = StudentYear::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Student year added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    //Student Year Edit
    public function studentyearedit($id)
    {
        $data = StudentYear::find($id);
        return view('backend.user.setup.year.student_year_edit', compact('data'));
    }

    //Student Year Update
    public function studentyearupdate(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|unique:student_years,name',
        ]);

        $updata = StudentYear::find($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Student year updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }

    //Student Year Delete
    public function studentyeardelete($id)
    {
        $delete = StudentYear::find($id)->delete();

        $notification = array(
            'message' => 'Student year deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
