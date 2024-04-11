<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AddressController extends Controller
{
    public function post_add_address(Request $request){
        if(Auth::user()){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'customer_name' => 'required',
                'phone' => 'required',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'address' => 'required'
            ], [
                'name.required' => trans('system.address_name_required'),
                'customer_name.required' => trans('system.address_customer_name_required'),
                'phone.required' => trans('system.address_province_required'),
                'province.required' => trans('system.address_name_required'),
                'district.required' => trans('system.address_district_required'),
                'ward.required' => trans('system.address_address_required'),
                'address.required' => trans('system.address_address_required'),
            ]);
            if ($validator->fails()) {
                return response()->json(array('status'=>0, 'error'=>$validator->errors(), 200));
//                trans('system.add_address_failed')
            }
            $address = new Address();
            $address->user_id = Auth::user()->id;
            $address->name = $request->name;
            $address->customer_name = $request->customer_name;
            $address->phone = $request->phone;
            $address->province = $request->province;
            $address->district = $request->district;
            $address->ward = $request->ward;
            $address->address = $request->address;
            $address->email = $request->email?$request->email:'';
            $address->save();
            return response()->json(array('status'=>1, 'msg'=> trans('system.add_address_success')), 200);
        }
        return response()->json(array('msg'=> trans('system.not_login'), 'status' => 0), 200);
    }
    public function delete_address(Request $request)
    {
        if (Auth::user() && $request->id) {
            $data = Address::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
            if($data){
                $data->delete();
                return response()->json(array(
                    'status' => 1,
                    'msg' => trans('page.delete_address_success'),
                ), 200);
            }
            return response()->json(array(
                'status' => 0,
                'msg' => trans('page.delete_address_failed_user'),
            ), 200);
        }
        return response()->json(array(
            'status' => 0,
            'msg' => trans('page.delete_address_failed'),
        ), 200);
    }
}
