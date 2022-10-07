<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
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
use Ramsey\Uuid\Nonstandard\UuidV6;
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
        if ($request->type != "add" && $request->type != "remove" && $request->type != 'quantity' && $request->type != "attribute") {
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

                $maximum = 0;
                foreach ($cart as $c) {
                    if ($c->product == $product->id) {
                        $maximum = $maximum + $c->quantity;
                    }
                }
                if ($maximum + ($request->quantity ? $request->quantity : 1) > $product->quantity) {
                    return response()->json(['message' => 'Max product quantity exceeded. (' . ($product->quantity - $maximum) . ' items in stock.)'], 400);
                }

                $item = new stdClass();
                $item->product = $product->id;
                $item->quantity = $request->quantity ? $request->quantity : 1;
                $item->attribute = $request->attribute;
                $item->id = UuidV6::uuid6();
                $cart[] = $item;

                Session::put('cart', $cart);
                return response()->json(['message' => 'Product added in cart.', 'count' => count($cart)], 200);
            } elseif ($request->type == "remove") {
                $filter = [];
                if (!$request->product_id) {
                    return response()->json(['message' => 'Cart id is required.'], 400);
                }
                $cart_id = $request->product_id;
                foreach ($cart as $list) {
                    if ($list->id != $cart_id) {
                        $filter[] = $list;
                    }
                }
                Session::put('cart', $filter);
                return response()->json(['message' => 'Item removed from cart.', 'count' => count($filter)], 200);
            } else if ($request->type == "quantity") {
                if (!$request->product_id) {
                    return response()->json(['message' => 'Cart id is required.'], 400);
                }
                if (!$request->quantity) {
                    return response()->json(['message' => 'Quantity is required.'], 400);
                }
                if (!$request->product) {
                    return response()->json(['message' => 'Product id is required.'], 400);
                }
                $cart_id = $request->product_id;
                $maximum = 0;

                foreach ($cart as $list) {
                    $product = Product::where(['id' => $request->product, 'status' => 1, 'deleted' => 0])->first();
                    $quantity = $list->quantity;
                    if (!$product) {
                        return response()->json(['message' => 'Product does not exists.', 'count' => count($cart)], 400);
                    }
                    if ($list->id == $cart_id) {
                        $quantity = $request->quantity;
                    }
                    if ($list->product == $product->id) {
                        $maximum = $maximum + $quantity;
                    }

                    if ($maximum > $product->quantity) {
                        return response()->json(['message' => 'Max product quantity exceeded.'], 400);
                    }
                }

                foreach ($cart as $list) {
                    $product = Product::where(['id' => $request->product, 'status' => 1, 'deleted' => 0])->first();
                    if ($list->id == $cart_id) {
                        $list->quantity = $request->quantity;
                    }
                }

                Session::put('cart', $cart);
                return response()->json(['message' => 'Quantity changed successfully.', 'count' => count($cart)], 200);
            } else {
                if (!$request->product_id) {
                    return response()->json(['message' => 'Product id is required.'], 400);
                }
                if (!$request->cart_id) {
                    return response()->json(['message' => 'Cart id is required.'], 400);
                }
                if (!$request->attribute) {
                    return response()->json(['message' => 'Attribute value is required.'], 400);
                }
                if (!$request->group) {
                    return response()->json(['message' => 'Attribute Group is required.'], 400);
                }
                foreach ($cart as $list) {
                    if ($list->id == $request->cart_id) {
                        $attribute = ProductAttribute::where(['product_id' => $request->product_id, 'id' => $request->attribute])->first();
                        if ($attribute) {
                            $list->attribute = $attribute->id;
                        }
                    }
                }

                Session::put('cart', $cart);
                return response()->json(['message' => 'Attribute value changed successfully.'], 200);
            }
        } else {
            return response()->json(['message' => 'Logged in user to be done.'], 400);
        }
    }

    public function cartIndex()
    {
        // DD(Session::get('cart', []));
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
            $subtotal = [];
            $subtotal['chf'] = 0;
            $subtotal['usd'] = 0;
            $subtotal['eur'] = 0;
            $subtotal['rub'] = 0;
            foreach ($items as $item) {
                $product = Product::where('id', $item->product)->first();
                if ($product) {
                    $product->cart_id = $item->id;
                    $product->cart_quantity = $item->quantity;
                    $product->images = ProductImage::where('product_id', $item->product)->orderBy('sort', 'ASC')->get();
                    $product->category = Category::where('id', $product->category_id)->first();
                    $product->attribute = $item->attribute;

                    if ($product->attribute) {
                        $product->price_chf = ProductAttribute::where('id', $product->attribute)->first()->price_chf;
                        $product->price_usd = ProductAttribute::where('id', $product->attribute)->first()->price_usd;
                        $product->price_eur = ProductAttribute::where('id', $product->attribute)->first()->price_eur;
                        $product->price_rub = ProductAttribute::where('id', $product->attribute)->first()->price_rub;
                    }

                    $subtotal['chf'] = $subtotal['chf'] + $product->cart_quantity * $product->price_chf;
                    $subtotal['eur'] = $subtotal['eur'] + $product->cart_quantity * $product->price_eur;
                    $subtotal['usd'] = $subtotal['usd'] + $product->cart_quantity * $product->price_usd;
                    $subtotal['rub'] = $subtotal['rub'] + $product->cart_quantity * $product->price_rub;

                    $product->allAttributes = ProductAttribute::where(['product_id' => $product->id, 'status' => 1, 'deleted' => 0])->get();
                    if (count($product->allAttributes) > 0) {
                        $product->attributeGroup = Attribute::where(['status' => 1, 'deleted' => 0, 'id' => $product->allAttributes[0]->attribute_id])->get();
                    } else {
                        $product->attributeGroup = [];
                    }
                    $products[] = $product;
                }
            }

            return view('Frontend.cart', compact('products', 'categories', 'pages', 'subtotal'));
        }
    }
}
