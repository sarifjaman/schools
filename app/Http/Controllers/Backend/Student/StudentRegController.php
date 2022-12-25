<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentRegController extends Controller
{
    //Student List
    public function studentregistrationview()
    {
        // $data['alldata'] = AssignStudent::all();
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        $data['year_id'] = StudentYear::orderBy('id', 'DESC')->first()->id;
        // dd($data['year_id']);
        $data['class_id'] = StudentClass::orderBy('id', 'DESC')->first()->id;
        // dd($data['class_id']);
        $data['alldata'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        // dd($data['alldata']);
        return view('backend.student.student_reg.student_registration_view', $data);
    }

    //Student Registration Add
    public function studentregistrationadd()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();
        return view('backend.student.student_reg.student_registration_add', $data);
    }

    //Store Student Registration
    public function storestudentregistration(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkyear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first();

            if ($student == null) {
                $studentReg = 0;
                $studentID = $studentReg + 1;

                if ($studentID < 10) {
                    $id_no = '000' . $studentID;
                } elseif ($studentID < 100) {
                    $id_no = '00' . $studentID;
                } elseif ($studentID < 100) {
                    $id_no = '0' . $studentID;
                }
            } else {
                $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first()->id;
                $studentID = $student + 1;

                if ($studentID < 10) {
                    $id_no = '000' . $studentID;
                } elseif ($studentID < 100) {
                    $id_no = '00' . $studentID;
                } elseif ($studentID < 100) {
                    $id_no = '0' . $studentID;
                }
            }

            $final_id = $checkyear . $id_no;

            $user = new User();
            $code = rand('0000', '9999');
            $user->id_no = $final_id;
            $user->password = bcrypt($code);
            $user->code = $code;
            $user->usertype = 'Student';
            $user->mobile = $request->mobile;
            $user->name = $request->name;
            $user->fathername = $request->fathername;
            $user->mothername = $request->mothername;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $image = $request->file('image');
                $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move('upload/student', $new_image);
                $user['image'] = $new_image;
            }

            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification = array(
            'message' => 'Student registered successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

    //Student Year Class Search
    public function studentyearclass(Request $request)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;

        $data['alldata'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.student.student_reg.student_registration_view', $data);
    }

    //Student Registration Edit
    public function studentregistrationedit($student_id)
    {
        // dd($student_id);

        $data['years'] = StudentYear::all();
        // dd($data['years']->toArray());

        $data['classes'] = StudentClass::all();
        // dd($data['classes']->toArray());

        $data['groups'] = StudentGroup::all();
        // dd($data['groups']->toArray());

        $data['shifts'] = StudentShift::all();
        // dd($data['shifts']->toArray());

        $data['editdata'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        // dd($data['editdata']->toArray());

        return view('backend.student.student_reg.student_registration_edit', $data);
    }

    //Student Registration Update
    public function studentregistrationupdate(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {

            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fathername = $request->fathername;
            $user->mothername = $request->mothername;
            $user->religion = $request->religion;
            $user->address = $request->address;
            $user->gender = $request->gender;

            if ($request->file('image')) {
                $image = $request->file('image');
                @unlink(public_path('upload/student/' . $user->image));
                $new_file = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload/student/', $new_file));
                $user['image'] = $new_file;
            }

            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->save();

            $assign_student = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification = array(
            'message' => 'Student registration updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

    //Student Registration Promotion
    public function studentregistrationpromotion($student_id)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['shifts'] = StudentShift::all();
        $data['groups'] = StudentGroup::all();

        $data['editdata'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

        // dd($data['editdata']->toArray());
        // dd($data['editdata']->toArray());
        return view('backend.student.student_reg.student_promotion', $data);
    }

    //Student Promotion Update
    public function studentpromotionupdate(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {
            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fathername = $request->fathername;
            $user->mothername = $request->mothername;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = $request->dob;

            if ($request->file('image')) {
                $image = $request->file('image');
                @unlink(public_path('upload/student/' . $image));
                $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move('upload/student/' . $new_image);
                $user['image'] = $new_image;
            }

            $user->save();


            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->fee_category_id = '1';
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification = array(
            'message' => 'Student promotion updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

    //Student Registration PDF
    public function studentregistrationpdf($student_id)
    {
        $data['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

        $pdf = Pdf::loadView('backend.student.student_reg.student_details', $data);
        return $pdf->download('invoice.pdf');
    }
}
