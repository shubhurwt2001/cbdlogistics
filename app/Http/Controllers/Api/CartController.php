<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Mail\ResetUserPasswordMail;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCart;
use Mail;
use DB;


class CartController extends Controller
{
    public function addCart(Request $request)
    {

        $validator = Validator::make($request->all(),
        [
            'product_id' => 'required',
            'quantity' => 'required',
        ], 
        [
            'product_id.required' => 'product_id is required',
            'quantity.required' => 'quantity is required'
            
        ]
       );
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $cart_total = 0;
        $user_id = auth('api')->user()->id;
        $product_id = $request->product_id;
        $crtCount = ProductCart::where('user_id',$user_id)->where('product_id',$product_id)->count();
 
        if($crtCount == 0)
        {
        $getProduct = Product::where('id',$product_id)->first();    
        $cart = new ProductCart();
        $cart->user_id = $user_id;
        $cart->product_id = $product_id;
        $cart->name = $getProduct->product_name;
        $cart->price = $getProduct->first_price;
        $cart->image = $getProduct->feature_image;
        $cart->quantity = $request->quantity;
        $cart->save();
    } else
    {
        $getCrt = ProductCart::where('user_id',$user_id)->where('product_id',$product_id)->first();
        $getCrt->quantity = $request->quantity;
        $getCrt->save();
    }

        $carts = ProductCart::where('user_id',$user_id)->get();
        foreach($carts as $cart)
        {
          $cart_total+= $cart->price;
        }

        $response = [
            'success' => true,
            'message' => 'Product added in cart',
            'carts' => $carts,
            'cart_total' => $cart_total,
        ];

        return response()->json($response, 200);
    }


    public function getCart(Request $request)
    {
        $cart_total = 0;
        $user_id = auth('api')->user()->id;
        $carts = ProductCart::where('user_id',$user_id)->get();

        foreach($carts as $cart)
        {
          $cart_total+= $cart->price;
        }

        $response = [
            'success' => true,
            'message' => 'Cart list',
            'carts' => $carts,
            'cart_total' => $cart_total,
        ];

        return response()->json($response, 200);
    }


    public function removeCart(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'product_id' => 'required',
        ], 
        [
            'product_id.required' => 'product_id is required',
        ]
       );

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $cart_total = 0;
        $user_id = auth('api')->user()->id;
        $del = ProductCart::where('user_id',$user_id)->where('product_id',$request->product_id)->delete();
        $carts = ProductCart::where('user_id',$user_id)->get();
        foreach($carts as $cart)
        {
          $cart_total+= $cart->price;
        }

        $response = [
            'success' => true,
            'message' => 'Product remove from cart',
            'carts' => $carts,
            'cart_total' => $cart_total,
        ];

        return response()->json($response, 200);
    }

    public function emptyCart(Request $request)
    {
        $user_id = auth('api')->user()->id;
        $del = ProductCart::where('user_id',$user_id)->delete();
        $carts = ProductCart::where('user_id',$user_id)->get();

        $response = [
            'success' => true,
            'message' => 'Empty cart',
            'carts' => $carts,
        ];

        return response()->json($response, 200);
    }


    

   

}
