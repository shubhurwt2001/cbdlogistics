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
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{

    public function product($slug)
    {
        $locale = App::getLocale();

        $pages = Page::where(['status' => 1, 'in_menu' => 1])->get();
        $categories = Category::where('status', 1)->get();

        foreach ($categories as $cat) {
            $cat->subcategories = Subcategory::where(['category_id' => $cat->id, 'status' => 1])->get();
        }

        $category = Category::where(['status' => 1, 'slug_' . $locale => $slug])->first();
        if ($category) {
            $category->products = Product::where(['status' => 1, 'category_id' => $category->id])->get();
            foreach ($category->products as $product) {
                $product->images = ProductImage::where('product_id', $product->id)->orderBy('sort', 'ASC')->get();
            }

            return view('Frontend.category', compact('category', 'categories', 'pages'));
        }

        $product = Product::where(['status' => 1, 'slug_' . $locale => $slug])->first();
        if ($product) {
            $product->images = ProductImage::where('product_id', $product->id)->orderBy('sort', 'ASC')->get();
            $product->category = Category::where(['status' => 1, 'id' => $product->category_id])->first();
            $product->subcategory = Subcategory::where(['status' => 1, 'id' => $product->subcategory_id])->first();
            $attributes = Attribute::where(['status' => 1, 'deleted' => 0])->get();
            $product->attributes = ProductAttribute::where(['product_id' => $product->id, 'status' => 1, 'deleted' => 0])->get()->groupBy('attribute_id');
            if ($product->category->status == 1) {
                if ($product->subcategory) {
                    if ($product->subcategory->status != 1) {
                        return abort(404);
                    }
                }
            } else {
                return abort(404);
            }

            return view('Frontend.product', compact('product', 'categories', 'pages', 'attributes'));
        }
        return abort(404);
    }


    public function subcategory($category, $subcategory)
    {
        $locale = App::getLocale();
        $pages = Page::where(['status' => 1, 'in_menu' => 1])->get();
        $categories = Category::where('status', 1)->get();
        foreach ($categories as $cat) {
            $cat->subcategories = Subcategory::where(['category_id' => $cat->id, 'status' => 1])->get();
        }

        $category = Category::where(['status' => 1, 'slug_' . $locale => $category])->first();

        if ($category) {
            $subcategory = Subcategory::where(['status' => 1, 'slug_' . $locale => $subcategory, 'category_id' => $category->id])->first();
            if ($subcategory) {
                $subcategory->category = $category;
                $subcategory->products = Product::where(['status' => 1, 'subcategory_id' => $subcategory->id])->get();
                foreach ($subcategory->products as $product) {
                    $product->images = ProductImage::where('product_id', $product->id)->orderBy('sort', 'ASC')->get();
                }
                return view('Frontend.subcategory', compact('subcategory', 'categories', 'pages'));
            } else {
                return abort(404);
            }
        }
        return abort(404);
    }
}
