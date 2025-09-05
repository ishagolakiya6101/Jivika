<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request,$token)
    {
        $email = $request->get('email');
        return view('_back.auth.reset', compact('token','email'));
    }
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|confirmed',
            'token' => 'required' 
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->with('error',$messages);
        }
    
        $tokenData = DB::table('password_resets')
        ->where(['token'=>$request->token,'email'=>$request->email])->first();
        if (!$tokenData) {
            return redirect()->back()->with('error','Something went wrong');
        }
        $user = Admin::where('email', $tokenData->email)->first();
        $user->update([
            'password'=>\Hash::make($request->password)
        ]);
        DB::table('password_resets')
        ->where('email',$request->email)->delete();
        return redirect()->to('admin/login')->with('success','password reset successfully');
    }
}
