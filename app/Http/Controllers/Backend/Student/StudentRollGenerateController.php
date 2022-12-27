<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentRollGenerateController extends Controller
{
    //Student Roll Generate View
    public function studentrollgenerateview()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('backend.student.roll_generate.roll_generate_view', $data);
    }

    //Student Registration Getstudents
    public function getstudents(Request $request)
    {
        $alldata = AssignStudent::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return response()->json($alldata);
    }

    //Student Roll Store
    public function rollstore(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if ($request->student_id != null) {
            for ($i = 0; $i < count($request->student_id); $i++) {
                AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->where('student_id', $request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            }
        } else {
            $notification = array(
                'message' => 'Sorry there are no student',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'Well done! Roll generated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.roll.generate.view')->with($notification);
    }
}
