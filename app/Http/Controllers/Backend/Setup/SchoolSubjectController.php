<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SchoolSubjectController extends Controller
{
    //School Subject Show
    public function schoolsubjectshow()
    {
        $data['alldata'] = SchoolSubject::all();
        return view('backend.user.setup.school_subject.school_subject_show', $data);
    }

    //School Subject Add
    public function schoolsubjectadd()
    {
        return view('backend.user.setup.school_subject.school_subject_add');
    }

    //School Subject Add
    public function schoolsubjectstore(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:school_subjects,name',
        ]);

        $data = SchoolSubject::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'School subject added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.show')->with($notification);
    }

    //School Subject Edit
    public function schoolsubjectedit($id)
    {
        $data = SchoolSubject::find($id);
        return view('backend.user.setup.school_subject.school_subject_edit', compact('data'));
    }

    //School Subject Update
    public function schoolsubjectupdate(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:school_subjects,name',
        ]);

        $data = SchoolSubject::find($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'School subject updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.show')->with($notification);
    }

    //School Subject Delete
    public function schoolsubjectdelete($id)
    {
        $data = SchoolSubject::find($id)->delete();

        $notification = array(
            'message' => 'School subject deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.show')->with($notification);
    }
}
