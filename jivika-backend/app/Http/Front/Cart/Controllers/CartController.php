<?php

namespace App\Http\Front\Cart\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Front\Cart\Models\Cart;
use App\Http\Front\Cart\Requests\AddCartRequest;
use App\Http\Front\Cart\Resources\CartResource;
use App\Http\Traits\ResponseTrait;
use Google\Service\CloudSourceRepositories\Repo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ResponseTrait;
    public function addCart(AddCartRequest $request)
    {
        $cart = Cart::where(['user_id' => auth()->user()->id, 'package_id' => $request->package_id])->first();
        if (!empty($cart)) {
            $cart->update(['quantity' => $request->quantity]);
            return $this->successResponse('Product updated successfully');
        }
        Cart::create([
            'user_id' => auth()->user()->id,
            'package_id' => $request->package_id,
            'quantity' => $request->quantity
        ]);
        return $this->successResponse('Product added successfully');
    }
    public function quantity(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $cart->update(['quantity' => $request->quantity]);
        return response()->json(['success' => 'Quantity added successfully']);
    }
    public function itemList(Request $request)
    {
        $items = Cart::where('user_id', auth()->id())->select('user_id', 'package_id', 'quantity', 'id')->with('package')->get();
        $data = CartResource::collection($items);
        $price = $items->sum('price');
        return $this->successResponse('Cart Item list',['items' => $data, 'price' => $price]);
    }
    public function removefromCart(Request $request)
    {
        $items = Cart::find($request->id);
        if (!$items)
            return response()->json(['error' => 'Item not found']);
        $items->delete();
        return response()->json(['success' => 'Item removed Successfully']);
    }
}
