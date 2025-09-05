<?php

namespace App\Http\Admin\ServiceProvider\Services;

use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use App\Http\Admin\ServiceProvider\Models\ServiceProviderAddress;
use App\Http\Admin\ServiceProvider\Resources\ServiceProviderResource;
use App\Http\Admin\User\Resource\UserResource;
use App\Models\ServiceProviderService as ModelsServiceProviderService;
use App\Models\TimeSlot;
use App\Models\User;
use App\Models\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class ServiceProviderService
{
    public function getNearbyLocations($request) 
    {
        $earthRadius = 6371;
        $latitude = $request->latitude; $longitude = $request->longitude; $distance = 10;
        $dLat = deg2rad($distance / $earthRadius);
        $dLon = deg2rad($distance / ($earthRadius * cos(deg2rad($latitude))));
        $minLat = $latitude - rad2deg($dLat);
        $maxLat = $latitude + rad2deg($dLat);
        $minLon = $longitude - rad2deg($dLon);
        $maxLon = $longitude + rad2deg($dLon);
        return ["minLat"=>$minLat,"maxLat"=>$maxLat,"minLon"=>$minLon,"maxLon"=>$maxLon];
        $nearbyLocations = ServiceProviderAddress::whereBetween('latitude', [$minLat, $maxLat])
            ->whereBetween('longitude', [$minLon, $maxLon])
            ->get();
        return $nearbyLocations;
    }
    public function register($request)
    {
        $role = Role::updateOrCreate(['name'=>$request->user_type],[
            'name'=>$request->user_type
        ]);
        $user= User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'password' => Hash::make($request->password),
        ])->assignRole($role);
        if($request->user_type == 'freelancer')
        {
            $provider = ServiceProvider::create([
                'description' => $request->description,
                'user_id'=>$user->id
            ]);
            foreach($request->services as $service)
            {
                ModelsServiceProviderService::create([
                    'service_provider_id'=>$provider->id,
                    'service_id'=>$service
                ]);
            }
        }
        
        return response()->json(['success'=>'Service Provider created successfully','data'=>$user]);
    }
    public function sendResetLinkEmail($request)
    {
        $token = Str::random(64);
        $url =url('provider/password/reset/'.$token.'?email='.urlencode($request->email));
        Mail::send('_back.auth.email', ['token' => $token,'email'=>$request->email,"url"=>$url], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return response()->json(['success'=>'Reset password link sent succefully to your email']);
    }
    public function reset($request)
    {
        $user = ServiceProvider::where('email', $request->email)->first();
        $user->update([
            'password'=>Hash::make($request->password)
        ]);
        return response()->json(['success'=>'password reset successfully']);
    }
    public function providerlist()
    {
        $user = User::whereHas('roles',function($data){
            $data->where('name','freelancer');
        })->with('provider')->get();
        return UserResource::collection($user);
    }
    public function timeSlot($request)
    {
        TimeSlot::create([
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'service_provider_id'=>auth()->user()->provicer->id,
        ]);
        return response()->json(['success'=>'Slot assigned successfully']);
    }
}