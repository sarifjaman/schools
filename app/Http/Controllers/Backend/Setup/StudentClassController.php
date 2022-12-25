<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    //Student Class View
    public function studentclassview()
    {
        $data['alldata'] = StudentClass::all();
        return view('backend.user.setup.student_class.class_view', $data);
    }

    //Student Class Add
    public function studentclassadd()
    {
        return view('backend.user.setup.student_class.student_class_add');
    }

    //Student Class Store
    public function studentclassstore(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:student_classes,name',
        ]);

        $data = StudentClass::insert([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Student class addedd successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }

    //Student Class Edit
    public function studentclassedit($id)
    {
        $data = StudentClass::find($id);
        return view('backend.user.setup.student_class.student_class_edit', compact('data'));
    }

    //Student Class Update
    public function studentclassupdate(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|unique:student_classes,name'
        ]);

        $data = StudentClass::find($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Student class updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    //Student Class Delete
    public function studentclassdelete($id)
    {
        $data = StudentClass::find($id)->delete();

        $notification = array(
            'name' => 'Student class deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.class.view')->with($notification);
    }
}
