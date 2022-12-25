<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    //fee Category Show
    public function feecategoryshow()
    {
        $data['alldata'] = FeeCategory::all();
        return view('backend.user.setup.fee.fee_category_show', $data);
    }

    //Fee Category Add
    public function feecategoryadd()
    {
        return view('backend.user.setup.fee.fee_category_add');
    }

    //Fee Category Store
    public function feecategorystore(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:fee_categories,name'
        ]);

        $data = FeeCategory::insert([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = array([
            'message' => 'Fee category added successfully',
            'alert-type' =>  'message'
        ]);

        return redirect()->route('fee.category.show')->with($notification);
    }

    //Fee Category Edit
    public function feecategoryedit($id)
    {
        $data = FeeCategory::find($id);
        return view('backend.user.setup.fee.fee_category_edit', compact('data'));
    }

    //Fee Category Update
    public function feecategoryupdate(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required|max:255|unique:fee_categories,name'
        ]);

        $data = FeeCategory::find($id)->update([
            'name' => $request->name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Fee category updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.show')->with($notification);
    }

    //Fee Category Delete
    public function feecategorydelete($id)
    {
        $data = FeeCategory::find($id)->delete();

        $notification = array(
            'message' => 'Fee category deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
