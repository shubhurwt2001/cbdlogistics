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
use App\Models\Wishlist;
use Mail;
use DB;


class WishListController extends Controller
{
    public function addWishList(Request $request)
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

        $user_id = auth('api')->user()->id;
        $product_id = $request->product_id;
        $crtCount = Wishlist::where('user_id',$user_id)->where('product_id',$product_id)->count();
 
        if($crtCount == 0)
        {
        $wish = new Wishlist();
        $wish->user_id = $user_id;
        $wish->product_id = $product_id;
        $wish->save();

        $msg = 'Product added in Wishlist';
    } else
    {
        $msg = 'Product already added in Wishlist';
    }

        $wishlist = Wishlist::leftJoin('products','products.id','wishlists.product_id')->where('wishlists.user_id',$user_id)->get();

        $response = [
            'success' => true,
            'message' => $msg,
            'wishlist' => $wishlist,
        ];

        return response()->json($response, 200);
    }


    public function getWishlist(Request $request)
    {
        $user_id = auth('api')->user()->id;
        $wishlist = Wishlist::leftJoin('products','products.id','wishlists.product_id')->where('wishlists.user_id',$user_id)->get();

        $response = [
            'success' => true,
            'message' => 'Wishlist Data',
            'wishlist' => $wishlist,
        ];

        return response()->json($response, 200);
    }


    public function removeWishlist(Request $request)
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
        $user_id = auth('api')->user()->id;
        $del = Wishlist::where('user_id',$user_id)->where('product_id',$request->product_id)->delete();
        $wishlist = Wishlist::leftJoin('products','products.id','wishlists.product_id')->where('wishlists.user_id',$user_id)->get();

        $response = [
            'success' => true,
            'message' => 'Product remove from Wishlist',
            'wishlist' => $wishlist,
        ];

        return response()->json($response, 200);
    }


    

   

}
