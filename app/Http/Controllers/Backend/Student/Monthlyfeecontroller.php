<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class Monthlyfeecontroller extends Controller
{
    //Student Monthly Fee View
    public function monthlyfeeview()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('backend.student.monthly_fee.monthly_fee_view', $data);
    }

    //Student Monthly Fee Class Wise
    public function monthlyfeeclasswise(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $month = $request->month;

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
        $html['thsource'] .= '<th>Monthly Fee</th>';
        $html['thsource'] .= '<th>Discount</th>';
        $html['thsource'] .= '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allstudent as $key => $v) {
            $monthlyfee = FeeCategoryAmount::where('fee_category_id', 2)->where('class_id', $class_id)->first();

            $color = 'success';

            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['id_no'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['student']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->roll . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $monthlyfee->amount . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v['discount']['discount'] . '</td>';

            $originalfee = $monthlyfee->amount;
            $discount = $v['discount']['discount'];
            $discounttablefee = $discount / 100 * $originalfee;
            $finalfee = (float)$originalfee - (float)$discounttablefee;

            $html[$key]['tdsource'] .= '<td>' . $finalfee . '/-' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class= "btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route("student.monthly.fee.payslip") . '?class_id=' . $v->class_id . '&student_id=' . $v->student_id . '&month=' . $request->month . '">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json($html);
    }

    //Student Monthly Fee Pay Slip
    public function monthlyfeepayslip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['month'] = $request->month;

        $data['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->where('class_id', $class_id)->first();

        $pdf = Pdf::loadView('backend.student.monthly_fee.monthly_fee_pdf', $data);
        return $pdf->stream('MonthlyFee.pdf');
    }
}
