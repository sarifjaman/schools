<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;
use App\Models\AccountStudentFee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    //Mothly-Yearly Profit View
    public function monthlyprofitview()
    {
        return view('backend.report.profit.profit_view');
    }

    //Monthly Profit Get
    public function monthlyprofitget(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $emp_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $total_cost = $other_cost + $emp_salary;
        $profit = $student_fee - $total_cost;

        $html['thsource'] = "<th>Student Fee</th>";
        $html['thsource'] .= "<th>Other Cost</th>";
        $html['thsource'] .= "<th>Employee Salary</th>";
        $html['thsource'] .= "<th>Total Cost</th>";
        $html['thsource'] .= "<th>Profit</th>";
        $html['thsource'] .= "<th>Action</th>";

        $color = "success";
        $html['tdsource'] = "<td>" . $student_fee . "</td>";
        $html['tdsource'] .= "<td>" . $other_cost . "</td>";
        $html['tdsource'] .= "<td>" . $emp_salary . "</td>";
        $html['tdsource'] .= "<td>" . $total_cost . "</td>";
        $html['tdsource'] .= "<td>" . $profit . "</td>";
        $html['tdsource'] .= "<td>";
        $html['tdsource'] .= '<a class="btn btn-sm btn-' . $color . '" title="PDF" target="_blanks" href="' . route('report.profit.pdf') . '?start_date=' . $sdate . '&end_date=' . $edate . '">Pay Slip</a>';
        $html['tdsource'] .= "</td>";

        return response()->json($html);
    }

    //Report Profit Pdf
    public function reportprofitpdf(Request $request)
    {
        $data['start_date'] = date('Y-m', strtotime($request->date));
        $data['end_date']   = date('Y-m', strtotime($request->end_date));
        $data['sdate']      = date('Y-m-d', strtotime($request->startdate));
        $data['edate']      = date('Y-m-d', strtotime($request->endate));

        $pdf = Pdf::loadView('backend.report.profit.monthly_profit_pdf', $data);
        return $pdf->stream('Monthlyprofit.pdf');
    }
}
