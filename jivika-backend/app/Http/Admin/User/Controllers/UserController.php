<?php

namespace App\Http\Admin\User\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Admin\User\ChangePasswordRequest;
use App\Http\Admin\User\Requests\ResetPasswordRequest;
use App\Http\Admin\User\Requests\UpdateUserRequest;
use App\Http\Admin\User\Requests\UserRegisterRequest;
use App\Http\Admin\User\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginUserAPIRequest;
use App\Http\Requests\API\LoginWithOtpAPIRequest;
use App\Http\Traits\ResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    use ResponseTrait;
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index(UserDataTable $datatable)
    {
        return $datatable->render('_back.customer.index');
    }
    public function login(LoginUserAPIRequest $request)
    {
        return $this->userService->login($request);
    }
    public function sendOtp(LoginWithOtpAPIRequest $request)
    {
        return $this->userService->sendOtp($request);
    }
    public function register(UserRegisterRequest $request)
    {
        return $this->userService->register($request);
    }
    public function profile(UpdateUserRequest $request)
    {
        return $this->userService->profile($request);
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        return $this->userService->changePassword($request);
    }
    public function delete(Request $request)
    {
        return $this->userService->delete($request);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:service_providers,email'
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->first();
            return redirect()->back()->with('error', $messages);
        }
        return $this->userService->sendResetLinkEmail($request);
    }
    public function reset(ResetPasswordRequest $request)
    {
        return $this->userService->reset($request);
    }
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function loginWithGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Check if the user exists in the database
        $user_data = User::where('email', $user->email)->first();

        if ($user_data) {
            // Update the existing user or perform any additional actions
            // For example, you might want to update the user's name or profile picture
            $user_data->update([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ]);
            auth()->login($user_data);
        } else {
            // Create a new user in the database
            $user_data = User::create([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'password' => Hash::make('Password')
            ]);

            // You may also want to log in the user at this point
            $auth_user = auth()->login($user_data);
            $token = JWTAuth::fromUser($auth_user);
        }

    }
    public function loginWithFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // Check if the user exists in the database
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            // Update the existing user or perform any additional actions
            // For example, you might want to update the user's name or profile picture
            $existingUser->update([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ]);
            auth()->login($existingUser);
        } else {
            // Create a new user in the database
            $newUser = User::create([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'password' => Hash::make('Password')
            ]);

            // You may also want to log in the user at this point
            auth()->login($newUser);
        }

        // Redirect or perform any other actions after user details are stored

        return redirect('admin/dashboard');
    }
}
