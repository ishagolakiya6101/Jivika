<?php

namespace App\Http\Admin\Address\Controllers;

use App\Http\Admin\Address\Requests\StoreAddressRequest;
use App\Http\Admin\Address\Models\Address;
use App\Http\Controllers\Controller;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use ResponseTrait;
    public function index() 
    {
        $addresses = auth()->user()->addresses;
        return $this->successResponse("Address list", $addresses);
    }
    public function create(StoreAddressRequest $request)
    {
        $user = auth()->user();
        $default_address = Address::where('user_id',auth()->user()->id)->where('default_address',1)->first();
        if($request->has('address_id') && $request->address_id != null){
            $address = Address::where('id',$request->address_id)->where('user_id',$user->id)->first();
            if(!$address){
                return $this->errorResponse('Address Not Found');
            }
            $address->update([
                'user_id' => $user->id,
                'flat_building_no' => $request->flat_building_no,
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'landmark' => $request->landmark,
                'address_type' => $request->address_type
            ]);
            if(!empty($default_address) && $request->default_address == 1)
            {
               $address->update(['default_address'=>1]);
               $default_address->update(['default_address'=>0]); 
            }
            return response()->json(['success'=>'Address updated successfully']);
        }else{
            $address = Address::create([
                'user_id' => auth()->user()->id,
                'flat_building_no' => $request->flat_building_no,
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'landmark' => $request->landmark,
                'address_type' => $request->address_type
            ]);
            if(!empty($default_address) && $request->default_address == 1)
            {
               $address->update(['default_address'=>1]);
               $default_address->update(['default_address'=>0]); 
            }
            return response()->json(['success'=>'Address added successfully']);
        }
    }
    public function delete(Request $request)
    {
        $address = Address::find($request->id);
        if ($address) {
            $address->delete();
            return response()->json(['success' => 'Address deleted Successfully']);
        } else {
            return response()->json(['error' => 'Address not found']);
        }
    }
}
