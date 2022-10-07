<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', 1)->get();
        $categories = Category::where('status', 1)->get();

        foreach ($categories as $cat) {
            $cat->subcategories = Subcategory::where(['category_id' => $cat->id, 'status' => 1])->get();
            $cat->products = Product::where(['status' => 1, 'category_id' => $cat->id])->get();
            foreach ($cat->products as $product) {
                $product->images = ProductImage::where('product_id', $product->id)->orderBy('sort', 'ASC')->get();
                $product->attributes = ProductAttribute::where(['status' => 1, 'deleted' => 0, 'product_id' => $product->id])->get()->groupBy('attribute_id');
                $product->allAttributes =  ProductAttribute::where(['status' => 1, 'deleted' => 0, 'product_id' => $product->id])->get();
            }
        }
        $attributes = Attribute::where(['status' => 1, 'deleted' => 0])->get();
        $pages = Page::where(['status' => 1, 'in_menu' => 1])->get();
        return view('Frontend.home', compact('banners', 'categories', 'pages', 'attributes'));
    }


    public function faq()
    {
        $pages = Page::where(['status' => 1, 'in_menu' => 1])->get();
        $categories = Category::where('status', 1)->get();
        $faqs = Faq::where('status', 1)->get();
        foreach ($categories as $cat) {
            $cat->subcategories = Subcategory::where(['category_id' => $cat->id, 'status' => 1])->get();
        }
        return view('Frontend.faq', compact('categories', 'pages', 'faqs'));
    }

    public function page($slug)
    {
        if (!$slug) {
            return abort(404);
        }

        $locale = App::getLocale();

        $page = Page::where(['slug_' . $locale => $slug, 'status' => 1])->first();

        if (!$page) {
            return abort(404);
        }

        $pages = Page::where(['status' => 1, 'in_menu' => 1])->get();

        $categories = Category::where('status', 1)->get();
        foreach ($categories as $cat) {
            $cat->subcategories = Subcategory::where(['category_id' => $cat->id, 'status' => 1])->get();
        }
        return view('Frontend.blank', compact('categories', 'pages', 'page'));
    }

    public function contact()
    {
        $pages = Page::where(['status' => 1, 'in_menu' => 1])->get();

        $categories = Category::where('status', 1)->get();
        foreach ($categories as $cat) {
            $cat->subcategories = Subcategory::where(['category_id' => $cat->id, 'status' => 1])->get();
        }
        return view('Frontend.contact', compact('categories', 'pages'));
    }

    public function changeLanguage(Request $request)
    {
        try {
            if (!$request->language) {
                return response()->json(['error' => 'Invalid request'], 400);
            }

            if (!in_array($request->language, ['en', 'fr', 'it', 'de'])) {
                return response()->json(['error' => 'Invalid request'], 400);
            }

            Session::put('locale', $request->language);

            return response()->json(['success' => true], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function changeCurrency(Request $request)
    {
        try {
            if (!$request->currency) {
                return response()->json(['error' => 'Invalid request'], 400);
            }

            if (!in_array($request->currency, ['eur', 'usd', 'rub', 'chf'])) {
                return response()->json(['error' => 'Invalid request'], 400);
            }

            Session::put('currency', $request->currency);

            return response()->json(['success' => true], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
