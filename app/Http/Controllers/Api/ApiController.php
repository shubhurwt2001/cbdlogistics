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
use App\Models\UserDetails;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Banner;
use App\Models\Post;
use App\Models\FAQ;
use App\Models\CouponCode;
use App\Models\ProductAttributeValue;
use App\Models\AttributeValue;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductCart;
use App\Models\Wishlist;
use App\Models\Language;
use App\Models\Currency;
use App\Models\Cms;
use Mail;
use DB;


class ApiController extends Controller
{
    ///public $banner_image_path = "http://50.116.13.170/clogistics/public/storage/images/banner/";

    public function getBanners(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'language_code' => 'required|string',
        // ]);
        // if ($validator->fails()) {
        //     return response(['errors' => $validator->errors()->all()], 422);
        // }

        if ($request->language_code == 'en') {
            $title = 'title_en as title';
            $description = 'description_en as description';
        } else if ($request->language_code == 'fr') {
            $title = 'title_fr as title';
            $description = 'description_fr as description';
        } else if ($request->language_code == 'de') {
            $title = 'title_de as title';
            $description = 'description_de as description';
        } else if ($request->language_code == 'it') {
            $title = 'title_it as title';
            $description = 'description_it as description';
        } else {
            $title = 'title_fr as title';
            $description = 'description_fr as description';
        }

        ////$banners = Banner::select(array(DB::raw("CONCAT('$this->banner_image_path', banner_img) AS banner_img"), 'banner_title', 'description'))->where('status', 1)->get();
        $banners = Banner::select('id',$title,$description,'url')->where('status', 1)->get();
        $response = [
            'success' => true,
            'message' => 'Banner data',
            'banners' => $banners,
        ];

        return response()->json($response, 200);
    }

    public function getCategory(Request $request)
    {

        if ($request->language_code == 'en') {
            $name = 'name_en as name';
            $slug = 'slug_en as slug';
            $image = 'image_slug_en as image';
        } else if ($request->language_code == 'fr') {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
            $image = 'image_slug_fr as image';
        } else if ($request->language_code == 'de') {
            $name = 'name_de as name';
            $slug = 'slug_de as slug';
            $image = 'image_slug_de as image';
        } else if ($request->language_code == 'it') {
            $name = 'name_it as name';
            $slug = 'slug_it as slug';
            $image = 'image_slug_it as image';
        } else {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
            $image = 'image_slug_fr as image';
        }

        $categories = Category::select('id',$name,$image,$slug)->where('status', 1)->get();

        $response = [
            'success' => true,
            'message' => 'Category data',
            'categories' => $categories,
        ];

        return response()->json($response, 200);
    }


    public function getLanguage(Request $request)
    {
        $languages = Language::where('status', 1)->get();

        $response = [
            'success' => true,
            'message' => 'Language data',
            'languages' => $languages,
        ];

        return response()->json($response, 200);
    }


    public function getCurrency(Request $request)
    {
        $currencies = Currency::where('status', 1)->get();

        $response = [
            'success' => true,
            'message' => 'Currency data',
            'currencies' => $currencies,
        ];

        return response()->json($response, 200);
    }


    public function getSubCategory(Request $request)
    {
        $category_id = $request->category_id;

        if ($request->language_code == 'en') {
            $name = 'name_en as name';
            $slug = 'slug_en as slug';
        } else if ($request->language_code == 'fr') {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
        } else if ($request->language_code == 'de') {
            $name = 'name_de as name';
            $slug = 'slug_de as slug';
        } else if ($request->language_code == 'it') {
            $name = 'name_it as name';
            $slug = 'slug_it as slug';
        } else {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
        }

        $subCategories = Subcategory::select('id','category_id',$name,$slug)->where('category_id', $category_id)->where('status', 1)->get();

        $response = [
            'success' => true,
            'message' => 'SubCategory data',
            'subcategories' => $subCategories,
        ];

        return response()->json($response, 200);
    }

    public function getCategoryProducts(Request $request)
    {
        $user_id = auth('api')->user()->id;

        if ($request->currency_code == 'usd') {
            $price = 'price_usd as price';
        } else if ($request->currency_code == 'eur') {
            $price = 'price_eur as price';
        } else if ($request->currency_code == 'rub') {
            $price = 'price_rub as price';
        } else if ($request->currency_code == 'it') {
            $price = 'price_chf as price';
        } else {
            $price = 'price_chf as price';
        }


        if ($request->language_code == 'en') {
            $name = 'name_en as name';
            $slug = 'slug_en as slug';
            $short_desc = 'short_desc_en as short_desc';
            $desc = 'desc_en as desc';
        } else if ($request->language_code == 'fr') {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
            $short_desc = 'short_desc_fr as short_desc';
            $desc = 'desc_fr as desc';
        } else if ($request->language_code == 'de') {
            $name = 'name_de as name';
            $slug = 'slug_de as slug';
            $short_desc = 'short_desc_de as short_desc';
            $desc = 'desc_de as desc';
        } else if ($request->language_code == 'it') {
            $name = 'name_it as name';
            $slug = 'slug_it as slug';
            $short_desc = 'short_desc_it as short_desc';
            $desc = 'desc_it as desc';
        } else {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
            $short_desc = 'short_desc_fr as short_desc';
            $desc = 'desc_fr as desc';
        }

        // $wishlists = Wishlist::where('user_id', $user_id)->get();
        $products = Product::select('id','category_id',$name,$price,$short_desc,$desc,$slug)->where('category_id', $request->category_id)->where('status', 1)->get();

        // foreach ($wishlists as $wish) {

        //     foreach ($products as $product) {
        //         if ($wish->product_id == $product->id) {
        //             $product->is_favorite = 1;
        //         } else {
        //             $product->is_favorite = 0;
        //         }
        //     }
        // }

        // $products = Product::addSelect(['products.*','is_favorite' => function ($query) {
        //     $query->select('product_id','user_id')
        //         ->from('wishlists')
        //         ->where('wishlists.user_id',4)
        //         ->whereColumn('product_id', 'id')
        //         ->count();
        // }])->get();



        // $products = Product::leftJoin('wishlists','wishlists.product_id','products.id')
        // ->selectRaw('products.*, count(wishlists.id) as is_favorite')
        // ->where('products.cat_id', $category_id)
        // ->groupBy('products.id')->get();

        //     $products = Product::query()
        // ->where('cat_id', '=', $category_id)
        // ->with(['Wishlist' => function ($hasMany) {
        //     $hasMany->where('user_id', auth('api')->user()->id);
        //     $hasMany->count();
        // }])
        // ->orderBy('id', 'desc')
        // ->get();



        $response = [
            'success' => true,
            'message' => 'Category Product data',
            'products' => $products,
        ];

        return response()->json($response, 200);
    }

    public function getSubCategoryProducts(Request $request)
    {
        $user_id = auth('api')->user()->id;

        if ($request->currency_code == 'usd') {
            $price = 'price_usd as price';
        } else if ($request->currency_code == 'eur') {
            $price = 'price_eur as price';
        } else if ($request->currency_code == 'rub') {
            $price = 'price_rub as price';
        } else if ($request->currency_code == 'it') {
            $price = 'price_chf as price';
        } else {
            $price = 'price_chf as price';
        }


        if ($request->language_code == 'en') {
            $name = 'name_en as name';
            $slug = 'slug_en as slug';
            $short_desc = 'short_desc_en as short_desc';
            $desc = 'desc_en as desc';
        } else if ($request->language_code == 'fr') {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
            $short_desc = 'short_desc_fr as short_desc';
            $desc = 'desc_fr as desc';
        } else if ($request->language_code == 'de') {
            $name = 'name_de as name';
            $slug = 'slug_de as slug';
            $short_desc = 'short_desc_de as short_desc';
            $desc = 'desc_de as desc';
        } else if ($request->language_code == 'it') {
            $name = 'name_it as name';
            $slug = 'slug_it as slug';
            $short_desc = 'short_desc_it as short_desc';
            $desc = 'desc_it as desc';
        } else {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
            $short_desc = 'short_desc_fr as short_desc';
            $desc = 'desc_fr as desc';
        }

        // $wishlists = Wishlist::where('user_id', $user_id)->get();
        $products = Product::select('id','subcategory_id',$name,$price,$short_desc,$desc,$slug)->where('subcategory_id', $request->subcategory_id)->where('status', 1)->get();

        // foreach ($wishlists as $wish) {

        //     foreach ($products as $product) {
        //         if ($wish->product_id == $product->id) {
        //             $product->is_favorite = 1;
        //         } else {
        //             $product->is_favorite = 0;
        //         }
        //     }
        // }

        $response = [
            'success' => true,
            'message' => 'SubCategory Product data',
            'products' => $products,
        ];

        return response()->json($response, 200);
    }


    public function productDetails(Request $request)
    {
        if ($request->currency_code == 'usd') {
            $price = 'price_usd as price';
        } else if ($request->currency_code == 'eur') {
            $price = 'price_eur as price';
        } else if ($request->currency_code == 'rub') {
            $price = 'price_rub as price';
        } else if ($request->currency_code == 'it') {
            $price = 'price_chf as price';
        } else {
            $price = 'price_chf as price';
        }


        if ($request->language_code == 'en') {
            $name = 'name_en as name';
            $slug = 'slug_en as slug';
            $short_desc = 'short_desc_en as short_desc';
            $desc = 'desc_en as desc';
        } else if ($request->language_code == 'fr') {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
            $short_desc = 'short_desc_fr as short_desc';
            $desc = 'desc_fr as desc';
        } else if ($request->language_code == 'de') {
            $name = 'name_de as name';
            $slug = 'slug_de as slug';
            $short_desc = 'short_desc_de as short_desc';
            $desc = 'desc_de as desc';
        } else if ($request->language_code == 'it') {
            $name = 'name_it as name';
            $slug = 'slug_it as slug';
            $short_desc = 'short_desc_it as short_desc';
            $desc = 'desc_it as desc';
        } else {
            $name = 'name_fr as name';
            $slug = 'slug_fr as slug';
            $short_desc = 'short_desc_fr as short_desc';
            $desc = 'desc_fr as desc';
        }


        $product = Product::select('id','category_id','subcategory_id',$name,$price,$short_desc,$desc,$slug)->where('id', $request->product_id)->where('status', 1)->first();
        ///$attribute = ProductAttributeValue::select('product_attribute_values.id as product_attribute_id', 'product_attribute_values.*', 'attribute_values.*', 'attributes.*')->leftJoin('attribute_values', 'attribute_values.id', 'product_attribute_values.attr_val_id')->leftJoin('attributes', 'attributes.id', 'attribute_values.attr_id')->where('product_attribute_values.product_id', $product_id)->get();

        $response = [
            'success' => true,
            'message' => 'Product details',
            'product' => $product,
            ///'attribute' => $attribute,
        ];

        return response()->json($response, 200);
    }


    public function getPost(Request $request)
    {
        $post = Post::where('status', 1)->get();

        $response = [
            'success' => true,
            'message' => 'post list',
            'post' => $post,
        ];

        return response()->json($response, 200);
    }


    public function getPostDetails(Request $request)
    {
        $post_id = $request->post_id;
        $post = Post::where('id', $post_id)->where('status', 1)->first();

        $response = [
            'success' => true,
            'message' => 'Post details',
            'post' => $post,
        ];

        return response()->json($response, 200);
    }



    public function getFaq(Request $request)
    {
        $faq = FAQ::where('status', 1)->get();

        $response = [
            'success' => true,
            'message' => 'Faq list',
            'faq' => $faq,
        ];

        return response()->json($response, 200);
    }


    public function getCoupon(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'coupon_code' => 'required',
            ],
            [
                'coupon_code.required' => 'coupon code is required',

            ]
        );
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $coupon_code = $request->coupon_code;
        $couponData = '';
        $couponCount = CouponCode::where('coupon_code', $coupon_code)->where('status', 1)->count();
        if ($couponCount != 0) {
            $couponData = CouponCode::where('coupon_code', $coupon_code)->where('status', 1)->first();
            $msg = "Coupon Code matched";
            $status = true;
        } else {
            $msg = "Coupon Code does not match";
            $status = false;
        }

        $response = [
            'success' => $status,
            'message' => $msg,
            'coupon' => $couponData,
        ];

        return response()->json($response, 200);
    }


    public function getProductPrice(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'attribute_id' => 'required',
            ],
            [
                'attribute_id.required' => 'attribute id is required',

            ]
        );
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $attribute_id = $request->attribute_id;
        $attr = '';
        $attrCount = AttributeValue::where('id', $attribute_id)->count();
        if ($attrCount != 0) {
            $attr = AttributeValue::where('id', $attribute_id)->first();
            $msg = "attribute data";
            $status = true;
        } else {
            $msg = "attribute_id does not match";
            $status = false;
        }

        $response = [
            'success' => $status,
            'message' => $msg,
            '$attribute' => $attr,
        ];

        return response()->json($response, 200);
    }


    public function createOrder(Request $request)
    {
        $user_id = auth('api')->user()->id;
        $user = User::where('id', $user_id)->first();

        $order = new Order();
        $order->user_id = $user_id;
        $order->status_id = 0;
        $order->name = $user->first_name . ' ' . $user->last_name;
        $order->mobile = $user->mobile;
        $order->email = $user->email;
        $order->save();

        $order_id = $order->id;
        $cart_items_count = ProductCart::where('user_id', $user_id)->count();
        $cart_items = ProductCart::where('user_id', $user_id)->get();
        $getTotal = 0;
        if ($cart_items_count != 0) {
            foreach ($cart_items as $item) {
                $orderItem = new orderItem();
                $orderItem->product_id = $item->product_id;
                $orderItem->order_id = $order_id;
                $orderItem->price = $item->price;
                $orderItem->quantity = $item->quantity;
                $orderItem->save();

                $getTotal += $item->price;
            }

            $updtOrder = Order::find($order_id);
            $updtOrder->sub_total = $getTotal;
            $updtOrder->save();


            $del = ProductCart::where('user_id', $user_id)->delete();
            $msg = 'Order created';
            $status = true;
        } else {
            $msg = 'Cart is empty';
            $status = false;
        }
        $orders = orderItem::leftJoin('products', 'order_item.product_id', 'products.id')->leftJoin('orders', 'orders.id', 'order_item.order_id')->where('orders.user_id', $user_id)->get();

        $response = [
            'success' => $status,
            'message' => $msg,
            'orders' => $orders,
        ];

        return response()->json($response, 200);
    }


    public function getOrders(Request $request)
    {
        $user_id = auth('api')->user()->id;
        $orders = orderItem::leftJoin('products', 'order_item.product_id', 'products.id')->leftJoin('orders', 'orders.id', 'order_item.order_id')->where('orders.user_id', $user_id)->get();

        $response = [
            'success' => true,
            'message' => 'Order list',
            'orders' => $orders,
        ];

        return response()->json($response, 200);
    }


    public function getCms(Request $request)
    {
        $about_us = Cms::where('id', 1)->get();
        $contact_us = Cms::where('id', 2)->get();
        $land_cultivation = Cms::where('id', 3)->get();

        $response = [
            'success' => true,
            'message' => 'CMS Pages',
            'about_us' => $about_us,
            'contact_us' => $contact_us,
            'land_cultivation' => $land_cultivation,
        ];

        return response()->json($response, 200);
    }
}
