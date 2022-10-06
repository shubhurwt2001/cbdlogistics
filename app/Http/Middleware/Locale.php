<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\Subcategory;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (Session::get('locale')) {
            if (!in_array($request->language, ['en', 'fr', 'it', 'de'])) {
                App::setLocale(Session::get('locale'));
            }
        }
        $locale = App::getLocale();

        if ($request->route()->getName() == 'page') {
            $page = Page::where('slug_en', $request->slug)->first();
            if (!$page) {
                $page = Page::where('slug_fr', $request->slug)->first();
                if (!$page) {
                    $page = Page::where('slug_it', $request->slug)->first();
                    if (!$page) {
                        $page = Page::where('slug_de', $request->slug)->first();
                    }
                }
            }

            if ($page && $request->slug != $page['slug_' . $locale]) {
                return redirect()->route('page', $page['slug_' . $locale]);
            }
        }

        if ($request->route()->getName() == 'product') {
            $category = Category::where('slug_en', $request->product)->first();
            if (!$category) {
                $category = Category::where('slug_fr', $request->product)->first();
                if (!$category) {
                    $category = Category::where('slug_it', $request->product)->first();
                    if (!$category) {
                        $category = Category::where('slug_de', $request->product)->first();
                    }
                }
            }

            if ($category && $request->product != $category['slug_' . $locale]) {
                return redirect()->route('product', $category['slug_' . $locale]);
            }

            $product = Product::where('slug_en', $request->product)->first();
            if (!$product) {
                $product = Product::where('slug_fr', $request->product)->first();
                if (!$product) {
                    $product = Product::where('slug_it', $request->product)->first();
                    if (!$product) {
                        $product = Product::where('slug_de', $request->product)->first();
                    }
                }
            }

            if ($product && $request->product != $product['slug_' . $locale]) {
                return redirect()->route('product', $product['slug_' . $locale]);
            }
        }

        if ($request->route()->getName() == 'subcategory') {
            $category = Category::where('slug_en', $request->category)->first();
            if (!$category) {
                $category = Category::where('slug_fr', $request->category)->first();
                if (!$category) {
                    $category = Category::where('slug_it', $request->category)->first();
                    if (!$category) {
                        $category = Category::where('slug_de', $request->category)->first();
                    }
                }
            }

            if ($category && $request->category != $category['slug_' . $locale]) {
                $subcategory = Subcategory::where(['slug_en' => $request->subcategory, 'category_id' => $category->id])->first();
                if (!$subcategory) {
                    $subcategory = Subcategory::where(['slug_fr' => $request->subcategory, 'category_id' => $category->id])->first();
                    if (!$subcategory) {
                        $subcategory = Subcategory::where(['slug_it' => $request->subcategory, 'category_id' => $category->id])->first();
                        if (!$subcategory) {
                            $subcategory = Subcategory::where(['slug_de' => $request->subcategory, 'category_id' => $category->id])->first();
                        }
                    }
                }
                if ($subcategory) {
                    return redirect()->route('subcategory', ['category' => $category['slug_' . $locale], 'subcategory' => $subcategory['slug_' . $locale]]);
                }
            }
        }
        return $next($request);
    }
}
