<?php

namespace App\Http\Admin\PaymentSetting\Controllers;

use App\Http\Admin\PaymentSetting\Models\PaymentSetting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $settings = PaymentSetting::all();
        $tax = $settings->where('key_name','tax')->first();
        $platform_fee = $settings->where('key_name','platform_fee')->first();
        $setting = [
            "tax"=>$tax->key_value ?? '',"platform_fee"=>$platform_fee->key_value ?? ''
        ];
        return view('_back.payment_settings' ,compact('setting'));
    }
    public function update(Request $request)
    {
        if($request->has('tax') && $request->tax != null)
        { 
            PaymentSetting::updateOrCreate(['key_name'=>'tax'],[
                'key_value'=>$request->tax
            ]);
        }
        if($request->has('platform_fee') && $request->platform_fee != null)
        { 
            PaymentSetting::updateOrCreate(['key_name'=>'platform_fee'],[
                'key_value'=>$request->platform_fee
            ]);
        }
        return redirect()->back()->with('success','Payment settings updated successfully');
    }
}
