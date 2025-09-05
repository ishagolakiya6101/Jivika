<?php

namespace App\Http\Admin\AdminUser\Controllers;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(AdminDataTable $datatable)
    {
        return $datatable->render('_back.admin');
    }
    public function userProfile()
    {
        return view('_back.profile');
    }
    public function userUpdate(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $user->update([
            'name'=>$request->name
        ]);
        return back()->with('success','Profile Updated Successfully');
    }
}
