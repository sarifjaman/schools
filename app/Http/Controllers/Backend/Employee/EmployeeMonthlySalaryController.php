<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EmployeeMonthlySalaryController extends Controller
{
    //Employee Monthly Salary View
    public function employeemonthlysalaryview()
    {
        return view('backend.employee.employee_monthly_salary.employee_monthly_salary_view');
    }

    //Employee Monthly Salary Get
    public function employeemonthlysalaryget(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));

        if ($date != "") {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();


        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($data as $key => $attend) {
            $totalabsent = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $countabsent = count($totalabsent->where('attend_status', 'Absent'));

            $color = "success";

            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'] . '</td>';

            $salary = (float)$attend['user']['salary'];
            $perdaysalary = (float)$salary / 30;
            $totalsalaryminus = (float)$perdaysalary * (float)$countabsent;
            $totalsalary = (float)$salary - (float)$totalsalaryminus;

            $html[$key]['tdsource'] .= '<td>' . $totalsalary . '/-' . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class= "btn btn-sm btn-' . $color . '" title="PaySlip" target="_blanks" href="' . route("employee.monthly.salary.payslip", $attend->employee_id) . '">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json($html);
    }

    public function employeemonthlysalarypayslip(Request $request, $employee_id)
    {
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();
        // dd($id->toArray());

        $date = date('Y-m', strtotime($id->date));

        if ($date != '') {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $id->employee_id)->get();
        // dd($data['details']->toArray());

        $pdf = Pdf::loadView('backend.employee.employee_monthly_salary.employee_monthly_salary_pdf', $data);
        return $pdf->stream('EmployeeMonthlySalary.pdf');
    }
}
