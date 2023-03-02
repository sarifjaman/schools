<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\MarkGrade;
use App\Models\StudentClass;
use App\Models\StudentMark;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarksheetController extends Controller
{
    //Marksheet Generate View
    public function marksheetgenerateview()
    {
        $data['years']     = StudentYear::orderBy('id', 'DESC')->get();
        $data['classes']   = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.report.marksheet.marksheet_view', $data);
    }

    //Report Marksheet Get
    public function reportmarksheetget(Request $request)
    {
        $year_id      = $request->year_id;
        $class_id     = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no        = $request->id_no;

        $fail_count = StudentMark::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->where('marks', '<', '33')->get()->count();
        // dd($fail_count);
        $singlestudent = StudentMark::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->first();

        if ($singlestudent == true) {
            $allmarks = StudentMark::with(['assign_subject', 'year'])->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->get();
            // dd($allmarks->toArray());

            $allgrades = MarkGrade::all();

            return view('backend.report.marksheet.marksheet_pdf', compact('allmarks', 'allgrades', 'fail_count'));
        } else {
            $notification = array(
                'message' => 'Sorry this criteria does not match',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
