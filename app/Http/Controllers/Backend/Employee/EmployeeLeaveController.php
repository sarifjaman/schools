<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    //Employee Leave View
    public function employeeleaveview()
    {
        $data['alldata'] = EmployeeLeave::orderBy('id', 'DESC')->get();
        return view('backend.employee.employee_leave.employee_leave_view', $data);
    }

    //Add Employee Leave
    public function addemployeeleave()
    {
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();

        return view('backend.employee.employee_leave.add_employee_leave', $data);
    }

    //Employee Leave Store
    public function employeeleavestore(Request $request)
    {
        if ($request->leave_purpose_id == "0") {
            $leave_purpose = new LeavePurpose();
            $leave_purpose->name = $request->name;
            $leave_purpose->save();

            $leave_purpose_id = $leave_purpose->id;
        } else {
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $data = new EmployeeLeave();
        $data->employee_id      = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date       = date('Y-m-d', strtotime($request->start_date));
        $data->end_date         = date('Y-m-d', strtotime($request->end_date));
        $data->save();

        $notification = array(
            'message'    => 'Employee leave added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.leave.view')->with($notification);
    }

    //Employee Leave Edit
    public function employeeleaveedit($id)
    {
        $data['editdata'] = EmployeeLeave::find(1);
        $data['employees'] = User::where('usertype', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();
        return view('backend.employee.employee_leave.employee_leave_edit', $data);
    }

    //Employee Leave Update
    public function employeeleaveupdate(Request $request, $id)
    {
        if ($request->leave_purpose_id == "0") {
            $leave_purpose = new LeavePurpose();
            $leave_purpose->name = $request->name;
            $leave_purpose->save();

            $leave_purpose_id = $leave_purpose->id;
        } else {
            $leave_purpose_id = $request->leave_purpose_id;
        }

        $employee_leave = EmployeeLeave::find($id);
        $employee_leave->employee_id      = $request->employee_id;
        $employee_leave->leave_purpose_id = $leave_purpose_id;
        $employee_leave->start_date       = date('Y-m-d', strtotime($request->date));
        $employee_leave->end_date         = date('Y-m-d', strtotime($request->end_date));
        $employee_leave->save();

        $notification = array(
            'message' => 'Employee leave update successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.leave.view')->with($notification);
    }

    //Employee Leave Delete
    public function employeeleavedelete($id)
    {
        $deletedata = EmployeeLeave::find($id);
        $deletedata->delete();

        $notification = array(
            'message' => 'Employee leave deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.leave.view')->with($notification);
    }
}
