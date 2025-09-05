<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('_back.auth.forgot');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins,email'
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->first();
            return redirect()->back()->with('error',$messages);
        }
        $token = Str::random(64);
        DB::table('password_resets')->upsert(
            [
                'email' => $request->email,     
                'token' => $token, 
                'created_at' => Carbon::now()
            ],
            ['email'],
            ['token','created_at']
        );
        $url =url('admin/password/reset/'.$token.'?email='.urlencode($request->email));
        Mail::send('_back.auth.email', ['token' => $token,'email'=>$request->email,"url"=>$url], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return redirect()->to('admin/login')->with('success','Reset password link sent succefully to your email');
    }
}
