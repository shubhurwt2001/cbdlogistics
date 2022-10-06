<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function submit(Request $request)
    {
        // return $request->categories;
        // foreach ($request->categories as $cat) {
        //     Category::insert($cat);
        // }

        // foreach ($request->subcategories as $cat) {
        //     Subcategory::insert($cat);
        // }

        foreach ($request->products as $cat) {
            Product::insert($cat);
        }

        return response()->json(['success' => true]);
    }
}
