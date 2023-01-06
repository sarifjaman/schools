<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use App\Models\Employeesalarylog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeRegController extends Controller
{
    //Employee View
    public function employeeview()
    {
        $data['alldata'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_reg.employee_reg_view', $data);
    }

    //Employee Registration Add
    public function employeeregistrationadd()
    {
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_reg.employee_reg_add', $data);
    }

    //Employee Registration Store
    public function employeeregistrationstore(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkyear = date('Ym', strtotime($request->join_date));
            $employee = User::where('usertype', 'employee')->orderBy('id', 'DESC')->first();

            if ($employee == null) {
                $employeeReg = 0;
                $employeeid = $employeeReg + 1;

                if ($employeeid < 10) {
                    $id_no = '000' . $employeeid;
                } elseif ($employeeid < 100) {
                    $id_no = '00' . $employeeid;
                } elseif ($employeeid < 1000) {
                    $id_no = '0' . $employeeid;
                }
            } else {
                $employee = User::where('usertype', 'employee')->orderBy('id', 'DESC')->first()->id;

                $employeeid = $employee + 1;

                if ($employeeid < 10) {
                    $id_no = '000' . $employeeid;
                } elseif ($employeeid < 100) {
                    $id_no = '00' . $employeeid;
                } elseif ($employeeid < 1000) {
                    $id_no = '0' . $employeeid;
                }
            }

            $final_id = $checkyear . $id_no;

            $user = new User();
            $code = rand(0000, 9999);
            $user->password = bcrypt($code);
            $user->id_no = $final_id;
            $user->name = $request->name;
            $user->usertype = 'employee';
            $user->fathername = $request->fathername;
            $user->mothername = $request->mothername;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->code = $code;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->join_date = date('Y-m-d', strtotime($request->join_date));

            if ($request->file('image')) {
                $image = $request->file('image');
                $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move('upload/employee', $new_image);
                $user['image'] = $new_image;
            }

            $user->save();

            $employee_salary = new Employeesalarylog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->effected_salary = date('Y-m-d', strtotime($request->join_date));
            $employee_salary->save();
        });

        $notification = array(
            'message' => 'Employee data inserted successfully!',
            'alert-type'  => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);
    }

    //Employee Registration Edit
    public function employeeregistrationedit($id)
    {
        $data['editdata'] = User::find($id);
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_reg.employee_reg_edit', $data);
    }

    //Employee Registration Update
    public function employeeregistrationupdate(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->fathername     = $request->fathername;
        $user->mothername     = $request->mothername;
        $user->mobile         = $request->mobile;
        $user->address        = $request->address;
        $user->gender         = $request->gender;
        $user->religion       = $request->religion;
        $user->dob            = date('Y-m-d', strtotime($request->dob));
        $user->designation_id = $request->designation_id;

        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink(public_path('upload/employee/' . $user->image));
            $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/employee', $new_image);
            $user['image'] = $new_image;
        }

        $user->save();

        $notification = array(
            'message' => 'Employee registration updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);
    }

    //Employee Registration Details
    public function employeeregistrationdetails($id)
    {
        $data['details'] = User::find($id);

        $pdf = Pdf::loadView('backend.employee.employee_reg.employee_details_pdf', $data);
        return $pdf->download('employee_registration.pdf');
    }
}
