<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\WishListController;
use App\Http\Middleware\CheckApiToken;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('create-auth', [UserController::class, 'createAuth']);
    Route::post('forgot-password', [UserController::class, 'forgotPassword']);
    Route::get('about', [UserController::class, 'about']);
    Route::get('privacy-policy', [UserController::class, 'privacyPolicy']);
    Route::get('terms-conditions', [UserController::class, 'termsConditions']);
    Route::get('get-countries', [UserController::class, 'getCountries']);
    Route::get('get-language', [ApiController::class, 'getLanguage']);
    Route::get('get-currency', [ApiController::class, 'getCurrency']);
});

Route::prefix('v1')->middleware([CheckApiToken::class])->group(function () {

    Route::get('user', [UserController::class, 'userDetails']);
    Route::post('update-user-profile', [UserController::class, 'updateUserProfile']);
    Route::post('favorite-product', [FriendController::class, 'favoriteProduct']);
    Route::post('unfavorite-product', [FriendController::class, 'unFavoriteProduct']);
    Route::get('get-favorites-product', [FriendController::class, 'getFavoritesProduct']);
    Route::post('send-notification', [UserController::class, 'sendNotification']);
    Route::post('change-password', [UserController::class, 'changePassword']);
    Route::get('logout', [UserController::class, 'logout']);

    Route::post('get-banners', [ApiController::class, 'getBanners']);
    Route::post('get-categories', [ApiController::class, 'getCategory']);
    Route::post('get-sub-categories', [ApiController::class, 'getSubCategory']);
    Route::post('get-category-products', [ApiController::class, 'getCategoryProducts']);
    Route::post('get-subcategory-products', [ApiController::class, 'getSubCategoryProducts']);
    Route::post('get-products-details', [ApiController::class, 'productDetails']);
    Route::post('get-product-price', [ApiController::class, 'getProductPrice']);
    Route::post('get-coupon', [ApiController::class, 'getCoupon']);
    Route::get('create-order', [ApiController::class, 'createOrder']);
    Route::get('get-orders', [ApiController::class, 'getOrders']);

    Route::get('get-post', [ApiController::class, 'getPost']);
    Route::get('get-post-details', [ApiController::class, 'getPostDetails']);
    Route::get('get-faq', [ApiController::class, 'getFaq']);

    Route::post('add-cart', [CartController::class, 'addCart']);
    Route::get('get-cart', [CartController::class, 'getCart']);
    Route::post('remove-cart', [CartController::class, 'removeCart']);
    Route::get('empty-cart', [CartController::class, 'emptyCart']);

    Route::post('add-wishlist', [WishListController::class, 'addWishlist']);
    Route::get('get-wishlist', [WishListController::class, 'getWishlist']);
    Route::post('remove-wishlist', [WishListController::class, 'removeWishlist']);

    Route::get('get-cms', [ApiController::class, 'getCms']);

});

Route::fallback(function () {
    return response()->json([
        'message' => 'Something went wrong. If error persists, contact to cbd logistics Team', 'success' => false
    ], 404);
});
