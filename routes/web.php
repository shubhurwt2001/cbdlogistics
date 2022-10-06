<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/upload_data', function () {
    return view('welcome');
});

Route::post('/submit-data', [Controller::class, 'submit']);


Route::get('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/login', [AuthController::class, 'loginPost'])->name('admin.login');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::group(['prefix' => 'banner'], function () {
        Route::get('/', [DashboardController::class, 'banner'])->name('admin.banner');
        Route::get('/create', [DashboardController::class, 'bannerCreate'])->name('admin.banner.create');
        Route::get('/{type}/{id}', [DashboardController::class, 'bannerAction'])->name('admin.banner.action');
        Route::post('/save', [DashboardController::class, 'bannerSave'])->name('admin.banner.save');
    });

    Route::group(['prefix' => 'faq'], function () {
        Route::get('/', [DashboardController::class, 'faq'])->name('admin.faq');
        Route::get('/create', [DashboardController::class, 'faqCreate'])->name('admin.faq.create');
        Route::get('/{type}/{id}', [DashboardController::class, 'faqAction'])->name('admin.faq.action');
        Route::post('/save', [DashboardController::class, 'faqSave'])->name('admin.faq.save');
    });


    Route::group(['prefix' => 'page'], function () {
        Route::get('/', [PageController::class, 'page'])->name('admin.page');
        Route::get('/create', [PageController::class, 'pageCreate'])->name('admin.page.create');
        Route::get('/{type}/{id}', [PageController::class, 'pageAction'])->name('admin.page.action');
        Route::post('/save', [PageController::class, 'pageSave'])->name('admin.page.save');
    });


    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CatalogController::class, 'category'])->name('admin.category');
        Route::get('/create', [CatalogController::class, 'categoryCreate'])->name('admin.category.create');
        Route::get('/{type}/{id}', [CatalogController::class, 'categoryAction'])->name('admin.category.action');
        Route::post('/save', [CatalogController::class, 'categorySave'])->name('admin.category.save');
    });

    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/', [CatalogController::class, 'subcategory'])->name('admin.subcategory');
        Route::get('/create', [CatalogController::class, 'subcategoryCreate'])->name('admin.subcategory.create');
        Route::get('/{type}/{id}', [CatalogController::class, 'subcategoryAction'])->name('admin.subcategory.action');
        Route::post('/save', [CatalogController::class, 'subcategorySave'])->name('admin.subcategory.save');
    });


    Route::group(['prefix' => 'product'], function () {
        Route::get('/', [CatalogController::class, 'product'])->name('admin.product');
        Route::group(['prefix' => 'attribute'], function () {
            Route::get('/', [CatalogController::class, 'productAttribute'])->name('admin.product.attribute');
            Route::post('/save', [CatalogController::class, 'productAttributeSave'])->name('admin.product.attribute.save');
            Route::get('/{type}/{id}', [CatalogController::class, 'productAttributeAction'])->name('admin.product.attribute.action');
        });
        Route::get('/create', [CatalogController::class, 'productCreate'])->name('admin.product.create');
        Route::get('/{type}/{id}', [CatalogController::class, 'productAction'])->name('admin.product.action');
        Route::post('/save', [CatalogController::class, 'productSave'])->name('admin.product.save');
    });
    Route::get('/product-image-delete/{id}', [CatalogController::class, 'productImageDelete'])->name('admin.productImageDelete');

    Route::group(['prefix' => 'attribute'], function () {
        Route::get('/', [CatalogController::class, 'attribute'])->name('admin.attribute');
        Route::get('/create', [CatalogController::class, 'attributeCreate'])->name('admin.attribute.create');
        Route::get('/{type}/{id}', [CatalogController::class, 'attributeAction'])->name('admin.attribute.action');
        Route::post('/save', [CatalogController::class, 'attributeSave'])->name('admin.attribute.save');
    });
});


Route::get('locale', [HomeController::class, 'changeLanguage'])->name('locale');
Route::get('currency', [HomeController::class, 'changeCurrency'])->name('currency');

Route::post('wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('cart', [WishlistController::class, 'cart'])->name('cart');

Route::group(['middleware' => 'locale'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/cart', [WishlistController::class, 'cartIndex'])->name('cart.index');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/page/{slug}', [HomeController::class, 'page'])->name('page');
    Route::get('/{product}', [ProductController::class, 'product'])->name('product');
    Route::get('/{category}/{subcategory}', [ProductController::class, 'subcategory'])->name('subcategory');
});
