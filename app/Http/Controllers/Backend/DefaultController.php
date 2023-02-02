<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    //Marks Get Subject
    public function marksgetsubject(Request $request)
    {
        $class_id = $request->class_id;
        $alldata = AssignSubject::with(['school_subject'])->where('class_id', $class_id)->get();
        return response()->json($alldata);
    }

    //Student Marks Get Students
    public function studentmarksgetstudents(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $alldata = AssignStudent::with(['student'])->where('year_id', $year_id)->where('class_id', $class_id)->get();
        return response()->json($alldata);
    }
}
