<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExamfeeController extends Controller
{
    //Student Exam Fee View
    public function examfeeview()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();

        return view('backend.student.exam_fee.exam_fee_view', $data);
    }

    //Student Exam Fee Classwise
    public function examfeeclasswise(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if ($year_id != '') {
            $where[] = ['year_id', 'like', $year_id . '%'];
        }

        if ($class_id != '') {
            $where[] = ['class_id', 'like', $class_id . '%'];
        }

        $allstudent = AssignStudent::with('discount')->where($where)->get();

        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll</th>';
        $html['thsource'] .= '<th>Exam Fee</th>';
        $html['thsource'] .= '<th>Discount</th>';
        $html['thsource'] .= '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allstudent as $key => $v) {
            $examfee = FeeCategoryAmount::where('fee_category_id', '4')->where('class_id', $class_id)->first();

            $color = 'success';

            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['id_no'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->roll . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $examfee->amount . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['discount']['discount'] . '</td>';

            $originalfee = $examfee->amount;
            $discount = $v['discount']['discount'];
            $discounttablefee = $discount / 100 * $originalfee;
            $finalfee = (float)$originalfee - (float)$discounttablefee;

            $html[$key]['tdsource'] .= '<td>' . $finalfee . '/-' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class= "btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route("student.exam.fee.payslip") . '?class_id=' . $v->class_id . '&student_id=' . $v->student_id . '&exam_type_id=' . $request->exam_type_id . '">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json($html);
    }

    //
    public function examfeepayslip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $alldata['exam_type'] = ExamType::where('id', $request->exam_type_id)->first()['name'];
        // dd($alldata['exam_type']);

        $alldata['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->where('class_id', $class_id)->first();

        $pdf = Pdf::loadView('backend.student.exam_fee.exam_fee_pdf', $alldata);
        return $pdf->stream('ExamFee.pdf');
    }
}
