<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use stdClass;

class WishlistController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        foreach ($categories as $cat) {
            $cat->subcategories = Subcategory::where(['category_id' => $cat->id, 'status' => 1])->get();
        }
        $pages = Page::where(['status' => 1, 'in_menu' => 1])->get();

        if (Auth::check()) {
            return abort(404);
        } else {
            $items = Session::get('wishlist', []);
            $products = [];
            foreach ($items as $item) {
                $product = Product::where('id', $item)->first();
                if ($product) {
                    $product->images = ProductImage::where('product_id', $item)->orderBy('sort', 'ASC')->get();
                    $product->category = Category::where('id', $product->category_id)->first();
                    $products[] = $product;
                }
            }

            return view('Frontend.wishlist', compact('products', 'categories', 'pages'));
        }
    }
    public function wishlist(Request $request)
    {
        if (!$request->product_id) {
            return response()->json(['message' => 'Product id is required.'], 400);
        }

        if ($request->type != "add" && $request->type != "remove") {
            return response()->json(['message' => 'Invalid Request.'], 400);
        }

        $product = Product::where(['id' => $request->product_id, 'status' => 1, 'deleted' => 0])->first();
        if (!$product) {
            return response()->json(['message' => 'Invalid Product.'], 400);
        }
        // return Auth::check();
        if (!Auth::check()) {
            $wishlist = Session::get('wishlist', []);

            if ($request->type == "add") {
                if (in_array($product->id, $wishlist)) {
                    return response()->json(['message' => 'Product already in wishlist.'], 400);
                } else {
                    $wishlist[] = $product->id;
                    Session::put('wishlist', $wishlist);
                    return response()->json(['message' => 'Product added in wishlist.', 'count' => count($wishlist)], 200);
                }
            } else {
                $filter = [];
                foreach ($wishlist as $list) {
                    if ($list != $request->product_id) {
                        $filter[] = $list;
                    }
                }
                Session::put('wishlist', $filter);
                return response()->json(['message' => 'Product removed from wishlist.', 'count' => count($filter)], 200);
            }
        } else {
            return response()->json(['message' => 'Logged in user to be done.'], 400);
        }
    }

    public function cart(Request $request)
    {
        if ($request->type != "add" && $request->type != "remove") {
            return response()->json(['message' => 'Invalid Request.'], 400);
        }

        // return Auth::check();
        if (!Auth::check()) {
            $cart = Session::get('cart', []);

            if ($request->type == "add") {
                if (!$request->product_id) {
                    return response()->json(['message' => 'Product id is required.'], 400);
                }
                $product = Product::where(['id' => $request->product_id, 'status' => 1, 'deleted' => 0])->first();
                if (!$product) {
                    return response()->json(['message' => 'Invalid Product.'], 400);
                }

                $item = new stdClass();
                $item->product = $product->id;
                $item->quantity = $request->quantity ? $request->quantity : 1;
                $item->attributes = gettype($request->attributes) == "array" ? $request->attributes : [];
                $cart[] = $item;

                Session::put('cart', $cart);
                return response()->json(['message' => 'Product added in cart.', 'count' => count($cart)], 200);
            } else {
                $filter = [];
                if (!$request->product_id) {
                    return response()->json(['message' => 'Cart id is required.'], 400);
                }
                $cart_id = $request->product_id;
                foreach ($cart as $list) {
                    if ($list->cart_id != $cart_id) {
                        $filter[] = $list;
                    }
                }
                Session::put('cart', $filter);
                return response()->json(['message' => 'Item removed from cart.', 'count' => count($filter)], 200);
            }
        } else {
            return response()->json(['message' => 'Logged in user to be done.'], 400);
        }
    }

    public function cartIndex()
    {
        $categories = Category::where('status', 1)->get();
        foreach ($categories as $cat) {
            $cat->subcategories = Subcategory::where(['category_id' => $cat->id, 'status' => 1])->get();
        }
        $pages = Page::where(['status' => 1, 'in_menu' => 1])->get();

        if (Auth::check()) {
            return abort(404);
        } else {
            $items = Session::get('cart', []);
            $products = [];
            foreach ($items as $item) {
                $product = Product::where('id', $item->product)->first();
                if ($product) {
                    $product->cart_quantity = $item->quantity;
                    $product->images = ProductImage::where('product_id', $item->product)->orderBy('sort', 'ASC')->get();
                    $product->category = Category::where('id', $product->category_id)->first();
                    $product->attributes = $item->attributes;
                    $proAttributes = ProductAttribute::where('product_id', $product->id)->get()->groupBy('attribute_id');

                    foreach($proAttributes as $attribute){
                        
                    }
                    $products[] = $product;
                }
            }
            dd($products);
            return view('Frontend.cart', compact('products', 'categories', 'pages'));
        }
    }
}
