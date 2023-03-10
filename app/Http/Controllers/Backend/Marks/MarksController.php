<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMark;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    //Marks Entry Add
    public function marksentryadd()
    {
        $data['years']     = StudentYear::all();
        $data['classes']   = StudentClass::all();
        $data['exam_type'] = ExamType::all();

        return view('backend.marks.marks_add', $data);
    }

    //Marks Entry Store
    public function marksentrystore(Request $request)
    {
        $studentcount = $request->student_id;

        if ($studentcount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data                    = new StudentMark();
                $data->student_id         = $request->student_id[$i];
                $data->id_no             = $request->id_no[$i];
                $data->year_id           = $request->year_id;
                $data->class_id          = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id      = $request->exam_type_id;
                $data->marks         = $request->marks[$i];
                $data->save();
            }
        }

        $notification = array(
            'message' => 'Marks inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    //Marks Entry Edit
    public function marksentryedit()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();

        return view('backend.marks.marks_edit', $data);
    }

    //Student Edit Get Students
    public function studenteditgetstudents(Request $request)
    {
        $year_id           = $request->year_id;
        $class_id          = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id      = $request->exam_type_id;

        $getstudent = StudentMark::with(['student'])->where('year_id', $year_id)->where('class_id', $class_id)->where('assign_subject_id', $assign_subject_id)->where('exam_type_id', $exam_type_id)->get();
        return response()->json($getstudent);
    }

    //Marks Entry Update
    public function marksentryupdate(Request $request)
    {
        StudentMark::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('assign_subject_id', $request->assign_subject_id)->where('exam_type_id', $request->exam_type_id)->delete();

        $getstudentcount = $request->student_id;

        if ($getstudentcount) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                $data                    = new StudentMark();
                $data->year_id           = $request->year_id;
                $data->class_id          = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id      = $request->exam_type_id;
                $data->student_id        = $request->student_id[$i];
                $data->marks             = $request->marks[$i];
                $data->id_no             = $request->id_no[$i];
                $data->save();
            }
        }

        $notification = array(
            'message'    => 'Marks updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
