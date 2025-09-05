<?php

namespace App\Http\Controllers\Auth;

use App\Http\Admin\User\Requests\UserRegisterRequest;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected function register(UserRegisterRequest $request)
    {
        return User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber ?? '',
            'password' => Hash::make($request->password),
        ]);
    }
}
