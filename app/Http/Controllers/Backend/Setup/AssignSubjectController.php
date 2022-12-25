<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    //Assign Subject Show
    public function assignsubjectshow()
    {
        // $data['alldata'] = AssignSubject::all();
        $data['alldata'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.user.setup.assign_subject.assign_subject_show', $data);
    }

    //Assign Subject Add
    public function assignsubjectadd()
    {
        $data['classes'] = StudentClass::all();
        $data['subjects'] = SchoolSubject::all();
        return view('backend.user.setup.assign_subject.assign_subject_add', $data);
    }

    //Assign Subject Store
    public function assignsubjectstore(Request $request)
    {
        $countsubject = count($request->subject_id);

        if ($countsubject != Null) {
            for ($i = 0; $i < $countsubject; $i++) {
                $assign_subjects = new AssignSubject();
                $assign_subjects->class_id = $request->class_id;
                $assign_subjects->subject_id = $request->subject_id[$i];
                $assign_subjects->fullmark = $request->fullmark[$i];
                $assign_subjects->passmark = $request->passmark[$i];
                $assign_subjects->subjective_mark = $request->subjective_mark[$i];
                $assign_subjects->save();
            }
        }

        $notification = array(
            'message' => 'Assign subject added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('assign.subject.show')->with($notification);
    }

    //Assign Subject Edit
    public function assignsubjectedit($class_id)
    {
        $data['classes'] = StudentClass::all();
        $data['subjects'] = SchoolSubject::all();
        $data['editdata'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'ASC')->get();
        return view('backend.user.setup.assign_subject.assign_subject_edit', $data);
    }

    //Assign Subject Update
    public function assignsubjectupdate(Request $request, $class_id)
    {
        if ($request->subject_id == Null) {
            $notification = array(
                'message' => 'Sorry you do not select any subject',
                'alert-type' => 'error'
            );
            return redirect()->route('assign.subject.show')->with($notification);
        } else {
            $countsubject = count($request->subject_id);

            for ($i = 0; $i < $countsubject; $i++) {
                $assign_subjects = new AssignSubject();
                $assign_subjects->class_id = $request->class_id;
                $assign_subjects->subject_id = $request->subject_id[$i];
                $assign_subjects->fullmark = $request->fullmark[$i];
                $assign_subjects->passmark = $request->passmark[$i];
                $assign_subjects->subjective_mark = $request->subjective_mark[$i];
                $assign_subjects->save();
            }
        }
        $notification = array(
            'message' => 'Assign subject updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('assign.subject.show')->with($notification);
    }

    //Assign Subject Detail
    public function assignsubjectdetail($class_id)
    {
        $data['detaildata'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'ASC')->get();
        return view('backend.user.setup.assign_subject.assign_subject_detail', $data);
    }
}
