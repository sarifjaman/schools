<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\MarkGrade;
use Illuminate\Http\Request;

class GradeControloler extends Controller
{
    //Marks Grade View
    public function marksgradeview()
    {
        $data['alldata'] = MarkGrade::all();
        return view('backend.marks.marks_grade_view', $data);
    }

    //Marks Grade Add
    public function marksgradeadd()
    {
        return view('backend.marks.marks_grade_add');
    }

    //Marks Grade Store
    public function marksgradestore(Request $request)
    {
        $data              = new MarkGrade();
        $data->grade_name  = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_mark  = $request->start_mark;
        $data->end_mark    = $request->end_mark;
        $data->start_point = $request->start_point;
        $data->end_point   = $request->end_point;
        $data->remarks     = $request->remarks;
        $data->save();

        $notification = array(
            'message'    => 'Grade marks inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('marks.grade.view')->with($notification);
    }

    //Marks Grade Edit
    public function marksgradeedit($id)
    {
        $data['editdata'] = MarkGrade::find($id);
        return view('backend.marks.marks_grade_edit', $data);
    }

    //Marks Grade Update
    public function marksgradeupdate(Request $request, $id)
    {
        $data              = MarkGrade::find($id);
        $data->grade_name  = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_mark  = $request->start_mark;
        $data->end_mark    = $request->end_mark;
        $data->start_point = $request->start_point;
        $data->end_point   = $request->end_point;
        $data->remarks     = $request->remarks;
        $data->save();

        $notification = array(
            'message'    => 'Grade mark updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('marks.grade.view')->with($notification);
    }
}
