<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{ 
    use AuthenticatesUsers;
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('_back.auth.login');
    }
    public function login(Request $request){

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
             return redirect()->route('admin.dashboard')->with('success', 'Login successfully.');
        }
        return redirect()->to('admin/login')->with('error', 'Authentication failed.');
    }
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->flash('action', 'logout');
        return redirect()->to('admin/login');
    }
}
