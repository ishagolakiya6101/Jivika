<?php

namespace App\Http\Admin\User\Services;

use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use App\Http\Admin\User\Requests\UserRegisterRequest;
use App\Http\Admin\User\Resource\UserResource;
use App\Http\Traits\ResponseTrait;
use App\Models\ServiceProviderService;
use App\Models\User;
use App\Models\UserService as ModelsUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    use ResponseTrait;
    public function sendOtp($request)
    {
        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expiry = now()->addMinutes(10);
        $user->save();
        $userEmail = $user->email;
        $subject = 'Otp for login';
        $content = 'Your otp for login is ' . $otp . '.
        this will expire in ' . now()->addMinutes(5) . '.';
        Mail::raw($content, function ($message) use ($userEmail, $subject) {
            $message->to($userEmail)->subject($subject);
        });
        return $this->successResponse('Otp Sent to your registered Email address');
        // $user->notify(new \App\Notifications\OTPNotification($otp));
    }
    public function login($request)
    {
        try {
            if ($request->has('password') && $request->password != null) {
                $credentials = $request->only('email', 'password');
                $token = JWTAuth::attempt($credentials);
                if (!$token) {
                    return $this->errorResponse("Login Failed", 401);
                }
                $user = JWTAuth::user();
                $user->token = $token;
            }
            if ($request->has('otp') && $request->otp != null) {
                $user = User::where('email', $request->email)->first();
                if ($user->otp != $request->otp) {
                    return $this->errorResponse('Otp is wrong');
                }
                if ($user->otp_expiry <= now()) {
                    return $this->errorResponse('Otp is expired');
                }
                auth()->login($user);
                $token = JWTAuth::fromUser($user);
                $user->token = $token;
            }
            $data = new UserResource($user);
            return $this->successResponse("Login Successful", $data);

            return $this->errorResponse("Login Failed", 401);
        } catch (\Exception $e) {
            return $this->errorResponse("An error occurred while logging in.", 500);
        }
    }

    public function register($request)
    {
        try {
            DB::beginTransaction();

            $role = Role::updateOrCreate(['name' => $request->user_type], [
                'name' => $request->user_type
            ]);


            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phonenumber' => $request->phonenumber,
                'password' => Hash::make($request->password),
            ])->assignRole($role);
            $name = $this->upload($request,$user->id);
            $user->update([
                'profile' => $name
            ]);

            if ($request->user_type == 'freelancer') {
                $provider = ServiceProvider::create([
                    'description' => $request->description,
                    'user_id' => $user->id
                ]);

                foreach ($request->services as $service) {
                    ServiceProviderService::create([
                        'service_provider_id' => $provider->id,
                        'service_id' => $service
                    ]);
                }
            }

            DB::commit(); // Commit transaction

            $user->token = JWTAuth::fromUser($user);
            $data = new UserResource($user);

            return $this->successResponse("User created successfully", $data);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction in case of error
            return $this->errorResponse("An error occurred while registering user.", 500);
        }
    }


    public function upload($request,$id)
    {
        try {
            if ($request->hasFile('profile_image') && $request->file('profile_image') != null) {
                $timestamp = now()->timestamp;
                $randomString = str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                $name = "{$id}_{$timestamp}_{$randomString}"; 
                // $name = $request->file('profile_image')->getClientOriginalName();
                $path = "public/image/user/" . $name;
                Storage::put($path, file_get_contents($request->file('profile_image')));
                return $name;
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
    public function profile($request)
    {
        try {
            // Begin transaction
            $user = User::where('uuid', $request->uuid)->first();
            DB::beginTransaction();
            $name = $this->upload($request,$user->id);
            if (!$user) {
                return $this->errorResponse('User not found', 404);
            }

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phonenumber' => $request->phonenumber,
                'profile' => $name ?? $user->profile
            ]);

            if (!empty($user->provider)) {
                $user->provider->update([
                    'title' => $request->title,
                    'description' => $request->description,
                ]);
            }

            // Commit transaction
            DB::commit();
            $data = new UserResource($user);
            return $this->successResponse("User's Details", $data);
        } catch (\Exception $e) {
            // Rollback transaction in case of any exception
            DB::rollBack();
            return $this->errorResponse("An error occurred while updating user's profile.", 500);
        }
    }

    public function delete($request)
    {
        try {
            // Begin transaction
            DB::beginTransaction();

            $user = User::find($request->id);

            if ($user) {
                $user->delete();
                // Commit transaction
                DB::commit();
                return $this->successResponse("User deleted Successfully");
            } else {
                return $this->errorResponse('User not found', 404);
            }
        } catch (\Exception $e) {
            // Rollback transaction in case of any exception
            DB::rollBack();
            return $this->errorResponse("An error occurred while deleting user.", 500);
        }
    }

    public function sendResetLinkEmail($request)
    {
        try {
            // Begin transaction
            DB::beginTransaction();

            $token = Str::random(64);
            $url = url('password/reset/' . $token . '?email=' . urlencode($request->email));

            Mail::send('_back.auth.email', ['token' => $token, 'email' => $request->email, "url" => $url], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            // Commit transaction
            DB::commit();

            return $this->successResponse("Reset password link sent successfully to your email");
        } catch (\Exception $e) {
            // Rollback transaction in case of any exception
            DB::rollBack();
            return $this->errorResponse("An error occurred while sending reset password email.", 500);
        }
    }
    public function changePassword($request)
    {
        $auth = Auth::user();
        // dd($auth);
        if (!Hash::check($request->get('current_password'), $auth->password)) 
        {
            return $this->errorResponse("Current Password is Invalid");
        }

        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) 
        {
            return $this->errorResponse("New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->update(['password'=>Hash::make($request->new_password)]);
        return $this->successResponse("Password Changed Successfully");
    }
    public function reset($request)
    {
        try {
            // Begin transaction
            DB::beginTransaction();

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return $this->errorResponse('User not found', 404);
            }

            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // Commit transaction
            DB::commit();

            return $this->successResponse("Password reset successfully");
        } catch (\Exception $e) {
            // Rollback transaction in case of any exception
            DB::rollBack();
            return $this->errorResponse("An error occurred while resetting password.", 500);
        }
    }
}
