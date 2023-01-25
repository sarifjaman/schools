<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    //Employee Attendance View
    public function employeeattendanceview()
    {
        $data['alldata'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id', 'DESC')->get();
        // $data['alldata'] = EmployeeAttendance::orderBy('id', 'DESC')->get();
        return view('backend.employee.employee_attendance.employee_attendance_view', $data);
    }

    //Employee Add Attendance
    public function employeeaddattendance()
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee_attendance.employee_attendance_add', $data);
    }

    //Employee Attendance Store
    public function employeeattendancestore(Request $request)
    {
        EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();

        $countemployee = count($request->employee_id);

        for ($i = 0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status' . $i;

            $attend                = new EmployeeAttendance();
            $attend->employee_id   = $request->employee_id[$i];
            $attend->date          = date('Y-m-d', strtotime($request->date));
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }

        $notification = array(
            'message'    => 'Employee attendance updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.attendance.view')->with($notification);
    }

    //Employee Atendence Edit
    public function employeateendanceedit($date)
    {
        $data['editdata'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = User::where('usertype', 'employee')->get();
        return view('backend.employee.employee_attendance.employee_atendance_edit', $data);
    }

    //Employee Attendance Details
    public function employeeattendancedetails($date)
    {
        $data['detaildata'] = EmployeeAttendance::where('date', $date)->get();
        return view('backend.employee.employee_attendance.employee_attendance_details', $data);
    }
}
