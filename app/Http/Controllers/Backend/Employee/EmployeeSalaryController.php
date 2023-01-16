<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employeesalarylog;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    //Employee Salary View
    public function employeesalaryview()
    {
        $data['alldata'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee_salary.employe_salary_view', $data);
    }

    //Employee Salary Increment
    public function employeesalaryincrement($id)
    {
        $data['editdata'] = User::find($id);
        return view('backend.employee.employee_salary.employee_salary_increment', $data);
    }

    //Employee Salary Increment Update
    public function employeesalaryincrementupdate(Request $request, $id)
    {
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary + (float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salaryData = new Employeesalarylog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salaryData->save();

        $notification = array(
            'message' => 'Employee salary updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.salary.view')->with($notification);
    }

    //Employee Salary Details
    public function employeesalarydetails($id)
    {
        $data['details'] = User::find($id);
        // dd($data['details']->id);

        $data['salary_log'] = Employeesalarylog::where('employee_id', $data['details']->id)->get();
        // dd($data['salary_log']->toArray());
        return view('backend.employee.employee_salary.employee_salary_details', $data);
    }
}
