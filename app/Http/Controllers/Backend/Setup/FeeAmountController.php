<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    //Fee Amount Show
    public function feeamountshow()
    {
        // $data['alldata'] = FeeCategoryAmount::all();
        $data['alldata'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.user.setup.fee_amount.fee_amount_show', $data);
    }

    //Fee Amount Add
    public function feeamountadd()
    {
        $data['category'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.user.setup.fee_amount.fee_amount_add', $data);
    }

    //Fee Amount Store
    public function feeamountstore(Request $request)
    {
        $countclass = count($request->class_id);

        if ($countclass != NULL) {
            for ($i = 0; $i < $countclass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }

        $notification = array(
            'message' => 'Fee amount added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.show')->with($notification);
    }

    //Fee Amount Edit
    public function feeamountedit($fee_category_id)
    {
        $data['category'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();

        $data['editdata'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'ASC')->get();

        return view('backend.user.setup.fee_amount.fee_amount_edit', $data);
    }

    //Fee Amount Edit
    public function feeamountupdate(Request $request, $fee_category_id)
    {
        // dd($request->fee_category_id);

        if ($request->class_id == Null) {
            $notification = array(
                'message' => 'Sorry you do not select any class amount',
                'alert-type' => 'error'
            );

            return redirect()->route('fee.amount.show', $fee_category_id)->with($notification);
        } else {
            $countclass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();

            for ($i = 0; $i < $countclass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->created_at = Carbon::now();
                $fee_amount->save();
            }


            $notification = array(
                'message' => 'Data updated successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('fee.amount.show')->with($notification);
        }
    }

    //Fee Amount Details
    public function feeamountdetails($fee_category_id)
    {
        $data['detailsdata'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'ASC')->get();
        return view('backend.user.setup.fee_amount.fee_amount_details', $data);
    }
}
