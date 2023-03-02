<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Models\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    //Other Cost View
    public function othercostview()
    {
        $data['alldata'] = AccountOtherCost::orderBy('id', 'DESC')->get();
        return view('backend.account.other_cost.other_cost_view', $data);
    }

    //Add Other Cost
    public function addothercost()
    {
        return view('backend.account.other_cost.other_cost_add');
    }

    //Other Cost Store
    public function othercoststore(Request $request)
    {
        $data         = new AccountOtherCost();
        $data->amount = $request->amount;
        $data->date   = date('Y-m-d', strtotime($request->date));

        if ($request->file('image')) {
            $image = $request->file('image');
            $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/other_cost', $new_image);
            $data['image'] = $new_image;
        }

        $data->description = $request->description;
        $data->save();

        $notification = array(
            'message' => 'Other cost added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('other.cost.view')->with($notification);
    }

    //Edit Other Cost
    public function editothercost($id)
    {
        $data['editdata'] = AccountOtherCost::find($id);
        return view('backend.account.other_cost.edit_other_cost', $data);
    }

    //Update Other Cost
    public function updateothercost(Request $request, $id)
    {
        $data         = AccountOtherCost::find($id);
        $data->amount = $request->amount;
        $data->date   = date('Y-m-d', strtotime($request->date));

        if ($request->file('image')) {
            $image = $request->file('image');
            @unlink(public_path('upload/other_cost/' . $data->image));
            $new_image = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move('upload/other_cost', $new_image);
            $data['image'] = $new_image;
        }

        $data->description = $request->description;
        $data->save();

        $notification = array(
            'message' => 'Other cost updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('other.cost.view')->with($notification);
    }
}
