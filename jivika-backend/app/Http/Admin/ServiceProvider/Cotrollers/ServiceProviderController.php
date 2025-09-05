<?php

namespace App\Http\Admin\ServiceProvider\Cotrollers;

use App\DataTables\ServiceProviderDataTable;
use App\Http\Admin\Service\Services\ServiceService;
use App\Http\Admin\ServiceProvider\Models\Booking;
use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use App\Http\Admin\ServiceProvider\Models\ServiceProviderAddress;
use App\Http\Admin\ServiceProvider\Requests\ServiceProviderRequest;
use App\Http\Admin\ServiceProvider\Services\ServiceProviderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\TimeSlotRequest;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Svg\Tag\Rect;
use Tymon\JWTAuth\Facades\JWTAuth;

class ServiceProviderController extends Controller
{
    use ResponseTrait;
    protected $serviceProviderService,$ServiceService;
    public function __construct(ServiceProviderService $serviceProviderService, ServiceService $ServiceService)
    {
        $this->serviceProviderService = $serviceProviderService;
        $this->ServiceService = $ServiceService;
    }
    public function index(ServiceProviderDataTable $datatable)
    {
        return $datatable->render('_back.provider.index');
    }
    public function getNearbyLocations(Request $request) 
    {
        return $this->serviceProviderService->getNearbyLocations($request);
    }
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = Auth::guard('service_provider')->attempt($credentials);
        if ($token) {
             return response()->json(['success'=> 'Login successfully.','token'=>$token]);
        }
        return response()->json(['error'=> 'Login Failed.']);
    }
    public function providerlist(Request $request)
    {
        $data = [
            'services'=>$this->ServiceService->serviceList($request),
            'freelancer'=>$this->serviceProviderService->providerlist($request)
        ];
        return $this->successResponse('Service Provider List.',$data);
    }
    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:service_providers,email'
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->first();
            return redirect()->back()->with('error',$messages);
        }
        return $this->serviceProviderService->sendResetLinkEmail($request);
    }
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:service_providers,email',
            'password' => 'required|confirmed',
            'token' => 'required' 
        ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->back()->with('error',$messages);
        }
        return $this->serviceProviderService->reset($request);
    }
    public function timeSlot(TimeSlotRequest $request)
    {
        return $this->serviceProviderService->timeSlot($request);
    }
}
