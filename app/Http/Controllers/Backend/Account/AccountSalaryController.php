<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;

class AccountSalaryController extends Controller
{
    //Account Salary View
    public function accountsalaryview()
    {
        $data['alldata'] = AccountEmployeeSalary::all();
        return view('backend.account.employee_salary.employee_salary_view', $data);
    }

    //Add Employee Salary
    public function addemployeesalary()
    {
        return view('backend.account.employee_salary.add_employee_salary');
    }

    //Employee Salary Get Account
    public function employeesalarygetaccount(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));

        if ($date != "") {
            $where[] = ['date', 'like', $date . '%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();

        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Name</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Select</th>';


        foreach ($data as $key => $attend) {
            $account_salary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)->where('date', $date)->first();

            if ($account_salary != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $totalabsent = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $countabsent = count($totalabsent->where('attend_status', 'Absent'));

            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['name'] . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['id_no'] . '<input type="hidden" name="date" value="' . $date . '">' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $attend['user']['salary'] . '</td>';

            $salary = (float)$attend['user']['salary'];
            $perdaysalary = (float)$salary / 30;
            $totalsalaryminus = (float)$perdaysalary * (float)$countabsent;
            $totalsalary = (float)$salary - (float)$totalsalaryminus;

            $html[$key]['tdsource'] .= '<td>' . $totalsalary . '<input type="hidden" name="amount[]" value="' . $totalsalary . '">' . '</td>';
            $html[$key]['tdsource'] .= '<td>' . '<input type="hidden" name="employee_id[]" value="' . $attend->employee_id . '">' . '<input type="checkbox" name="checkmanage[]" id="id{{$key}}" value="' . $key . '" ' . $checked . ' style="transform: scale(1.5);margin-left:10px;"> <label for="id{{$key}}"></label>' . '</td>';
        }

        return response()->json($html);
    }

    //Employee Salary Store
    public function mployeesalarystore()
    {
    }
}