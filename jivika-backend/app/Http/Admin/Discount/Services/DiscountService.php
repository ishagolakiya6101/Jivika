<?php

namespace App\Http\Admin\Discount\Services;

use App\Http\Admin\Discount\Resources\DiscountResource;
use App\Models\Discount;

class DiscountService
{

    public function create($request)
    {
        $discount = isset($request->discount_id) ? Discount::find($request->get('discount_id')) : [];
        if (isset($request->discount_id) && empty($discount))
            return redirect()->to('admin/discount')->with('error', 'discount not found');
        return view('_back.discount.create', compact('discount'));
    }
    public function store($request)
    {
        return Discount::create([
            'code' => $request->code,
            'start_date' => date('Y-m-d', strtotime($request->start_date)),
            'end_date' => date('Y-m-d', strtotime($request->end_date)),
            'value' => $request->value,
            'type' => $request->type,
            'max_users_limit' => $request->max_users_limit,
            'max_limit' => $request->max_limit,
        ]);
    }
    public function discountById($id)
    {
        return Discount::find($id);
    }
    public function update($request, $discount)
    {
        return $discount->update([
            'code' => $request->code,
            'start_date' => date('Y-m-d', strtotime($request->start_date)),
            'end_date' => date('Y-m-d', strtotime($request->end_date)),
            'value' => $request->value,
            'type' => $request->type,
            'max_users_limit' => $request->max_users_limit,
            'max_limit' => $request->max_limit,
        ]);
    }
    public function delete($request)
    {
        $discount = Discount::find($request->id);
        if ($discount) {
            $discount->delete();
            return response()->json(['success' => 'Discount deleted Successfully']);
        } else {
            return response()->json(['error' => 'Discount not found']);
        }
    }
    public function show()
    {
        $discount = Discount::all();
        return DiscountResource::collection($discount);
    }
    public function discount_details()
    {
        $discount = Discount::where('code', request()->discount_code)->first();
        return new DiscountResource($discount);
    }
}
