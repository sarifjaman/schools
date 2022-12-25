<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    //Exam Type Show
    public function examtypeshow()
    {
        $data['alldata'] = ExamType::all();
        return view('backend.user.setup.exam.exam_type_show', $data);
    }

    //Exam Type Add
    public function examtypeadd()
    {
        return view('backend.user.setup.exam.exam_type_add');
    }

    //Exam Type Store
    public function examtypestore(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:exam_types,name',
        ]);

        $data = ExamType::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Exam type inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('exam.type.show')->with($notification);
    }

    //Exam Type Edit
    public function examtypeedit($id)
    {
        $data = ExamType::find($id);
        return view('backend.user.setup.exam.exam_type_edit', compact('data'));
    }

    //Exam Type Update
    public function examtypeupdate(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:exam_types,name',
        ]);

        $data = ExamType::find($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Exam type updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('exam.type.show')->with($notification);
    }

    //Exam Type Delete
    public function examtypedelete($id)
    {
        $data = ExamType::find($id)->delete();

        $notification = array(
            'message' => 'Exam type deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('exam.type.show')->with($notification);
    }
}
