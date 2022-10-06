<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use stdClass;

class CatalogController extends Controller
{
    public function category()
    {
        $categories = Category::where('deleted', 0)->get();
        return view('Admin.category.index', compact('categories'));
    }

    public function categoryCreate()
    {
        return view('Admin.category.create');
    }

    public function categoryAction($type, $id)
    {
        $category = Category::findOrFail($id);

        if ($category->deleted == 1) {
            return abort(404);
        }
        if ($type == "edit") {
            return view('Admin.category.edit', compact('category'));
        }
        if ($type == "delete") {
            Category::where('id', $id)->update(['deleted' => 1]);

            Subcategory::where('category_id', $id)->update(['deleted' => 1]);
            Product::where('category_id', $id)->update(['deleted' => 1]);

            return redirect()->back()->with(['message' => 'Category deleted successfully.']);
        }
        if ($type == "status") {
            $category->status = $category->status == 1 ? 0 : 1;
            $category->save();
            if ($category->status == 0) {
                Subcategory::where('category_id', $id)->update(['status' => 0]);
                Product::where('category_id', $id)->update(['status' => 0]);
            }
            return redirect()->back()->with(['message' => 'Status changed successfully.']);
        }
        return abort(404);
    }

    public function categorySave(Request $request)
    {
        if (!$request->id) {
            $this->validate($request, [
                'name_en' => 'required',
                'name_fr' => 'required',
                'name_de' => 'required',
                'name_it' => 'required',
                'slug_en' => 'required',
                'slug_fr' => 'required',
                'slug_de' => 'required',
                'slug_it' => 'required',
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            ]);

            $category = new Category();
            $msg = "Category saved successfully";
        } else {
            $this->validate($request, [
                'name_en' => 'required',
                'name_fr' => 'required',
                'name_de' => 'required',
                'name_it' => 'required',
                'slug_en' => 'required',
                'slug_fr' => 'required',
                'slug_de' => 'required',
                'slug_it' => 'required',
            ]);
            $category = Category::findOrFail($request->id);
            if ($category->deleted == 1) {
                return abort(404);
            }
            $msg = "Category updated successfully";
        }

        try {
            $arr = ['en', 'it', 'fr', 'de'];
            $image = null;
            foreach ($arr as $local) {
                if (!$request->id) {
                    $already = $already = Category::where('slug_' . $local, $request['slug_' . $local])->count();
                    if ($already > 0) {
                        $request['slug_' . $local] = (Category::orderBy('id','DESC')->first()->id + 1) . '-' . $request['slug_' . $local];
                    }
                } else {
                    if ($request['slug_' . $local] != $category['slug_' . $local]) {
                        $already = $already = Category::where('slug_' . $local, $request['slug_' . $local])->count();
                        if ($already > 0) {
                            $request['slug_' . $local] = (Category::orderBy('id','DESC')->first()->id + 1) . '-' . $request['slug_' . $local];
                        }
                    }
                }

                if ($request->hasFile('image')) {

                    if ($request->id) {
                        if ($category['image_slug_' . $local]) {
                            File::delete(public_path('/storage/categories/' . $local . '/' . $category['image_slug_' . $local]));
                        }
                    }

                    $filename =  preg_replace('/\s+/', '-', $request['slug_' . $local]) . '.' . $request->file('image')->getClientOriginalExtension();

                    $destination = '/categories/' . $local . '/' . $filename;

                    if (!$image) {
                        $request->image->move(public_path() . '/storage/categories/' . $local . '/', $filename);
                        $image = $destination;
                    } else {
                        Storage::disk('public')->copy($image, $destination);
                    }

                    $category['image_slug_' . $local] = '/storage/categories/' . $local . '/' . $filename;
                }
            }

            $category->name_en = $request->name_en;
            $category->name_fr = $request->name_fr;
            $category->name_de = $request->name_de;
            $category->name_it = $request->name_it;
            $category->slug_en = $request->slug_en;
            $category->slug_fr = $request->slug_fr;
            $category->slug_de = $request->slug_de;
            $category->slug_it = $request->slug_it;
            $category->meta_title_en = $request->meta_title_en;
            $category->meta_title_fr = $request->meta_title_fr;
            $category->meta_title_de = $request->meta_title_de;
            $category->meta_title_it = $request->meta_title_it;
            $category->meta_content_en = $request->meta_content_en;
            $category->meta_content_fr = $request->meta_content_fr;
            $category->meta_content_de = $request->meta_content_de;
            $category->meta_content_it = $request->meta_content_it;
            $category->meta_keyword_en = $request->meta_keyword_en;
            $category->meta_keyword_fr = $request->meta_keyword_fr;
            $category->meta_keyword_de = $request->meta_keyword_de;
            $category->meta_keyword_it = $request->meta_keyword_it;
            $category->save();

            return redirect()->route('admin.category')->with(['message' => $msg]);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function subcategory()
    {
        $subcategories = Subcategory::where('deleted', 0)->get();
        foreach ($subcategories as $subcategory) {
            $subcategory->category = Category::where('id', $subcategory->category_id)->first();
        }
        return view('Admin.subcategory.index', compact('subcategories'));
    }

    public function subcategoryCreate()
    {
        $categories = Category::where('deleted', 0)->get();
        return view('Admin.subcategory.create', compact('categories'));
    }

    public function subcategoryAction($type, $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        if ($subcategory->deleted == 1) {
            return abort(404);
        }
        if ($type == "edit") {
            $categories = Category::where('deleted', 0)->get();
            return view('Admin.subcategory.edit', compact('subcategory', 'categories'));
        }
        if ($type == "delete") {
            Subcategory::where('id', $id)->delete();
            Product::where('subcategory_id', $id)->update(['subcategory_id' => null]);
            return redirect()->back()->with(['message' => 'Subcategory deleted successfully.']);
        }
        if ($type == "status") {
            $subcategory->status = $subcategory->status == 1 ? 0 : 1;
            $subcategory->save();
            if ($subcategory->status == 0) {
                Product::where('subcategory_id', $id)->update(['subcategory_id' => null]);
            }
            return redirect()->back()->with(['message' => 'Status changed successfully.']);
        }
        return abort(404);
    }


    public function subcategorySave(Request $request)
    {

        $this->validate($request, [
            'category_id' => 'required',
            'name_en' => 'required',
            'name_fr' => 'required',
            'name_de' => 'required',
            'name_it' => 'required',
            'slug_en' => 'required',
            'slug_fr' => 'required',
            'slug_de' => 'required',
            'slug_it' => 'required',
        ]);
        $category = Category::findOrFail($request->category_id);
        if ($category->deleted == 1) {
            return abort(404);
        }
        if (!$request->id) {
            $subcategory = new Subcategory();
            $msg = "Subcategory saved successfully";
        } else {
            $subcategory = Subcategory::findOrFail($request->id);
            if ($subcategory->deleted == 1) {
                return abort(404);
            }
            $msg = "Subcategory updated successfully";
        }

        try {
            $arr = ['en', 'it', 'fr', 'de'];

            foreach ($arr as $local) {
                if (!$request->id) {
                    $already = $already = Subcategory::where('slug_' . $local, $request['slug_' . $local])->count();
                    if ($already > 0) {
                        $request['slug_' . $local] = (Subcategory::orderBy('id','DESC')->first()->id + 1) . '-' . $request['slug_' . $local];
                    }
                } else {
                    if ($request['slug_' . $local] != $subcategory['slug_' . $local]) {
                        $already = $already = Subcategory::where('slug_' . $local, $request['slug_' . $local])->count();
                        if ($already > 0) {
                            $request['slug_' . $local] = (Subcategory::orderBy('id','DESC')->first()->id + 1) . '-' . $request['slug_' . $local];
                        }
                    }
                }
            }
            $subcategory->category_id = $request->category_id;
            $subcategory->name_en = $request->name_en;
            $subcategory->name_fr = $request->name_fr;
            $subcategory->name_de = $request->name_de;
            $subcategory->name_it = $request->name_it;
            $subcategory->slug_en = $request->slug_en;
            $subcategory->slug_fr = $request->slug_fr;
            $subcategory->slug_de = $request->slug_de;
            $subcategory->slug_it = $request->slug_it;
            $subcategory->meta_title_en = $request->meta_title_en;
            $subcategory->meta_title_fr = $request->meta_title_fr;
            $subcategory->meta_title_de = $request->meta_title_de;
            $subcategory->meta_title_it = $request->meta_title_it;
            $subcategory->meta_content_en = $request->meta_content_en;
            $subcategory->meta_content_fr = $request->meta_content_fr;
            $subcategory->meta_content_de = $request->meta_content_de;
            $subcategory->meta_content_it = $request->meta_content_it;
            $subcategory->meta_keyword_en = $request->meta_keyword_en;
            $subcategory->meta_keyword_fr = $request->meta_keyword_fr;
            $subcategory->meta_keyword_de = $request->meta_keyword_de;
            $subcategory->meta_keyword_it = $request->meta_keyword_it;
            $subcategory->save();
            return redirect()->route('admin.subcategory')->with(['message' => $msg]);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function product()
    {
        $products = Product::where('deleted', 0)->get();
        foreach ($products as $product) {
            $product->category = Category::findOrFail($product->category_id);
            $product->subcategory = Subcategory::where('id', $product->subcategory_id)->first();
        }
        return view('Admin.product.index', compact('products'));
    }

    public function productCreate()
    {
        $categories = Category::where('deleted', 0)->get();
        $subcategories = Subcategory::where('deleted', 0)->get();
        return view('Admin.product.create', compact('subcategories', 'categories'));
    }

    public function productAction($type, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->deleted == 1) {
            return abort(404);
        }
        if ($type == "edit") {
            $categories = Category::where('deleted', 0)->get();
            $subcategories = Subcategory::where('deleted', 0)->get();
            $product->images = ProductImage::where('product_id', $product->id)->orderBy('sort', 'ASC')->get();
            return view('Admin.product.edit', compact('product', 'subcategories', 'categories'));
        }
        if ($type == "delete") {
            $product->deleted = 1;
            $product->save();
            return redirect()->back()->with(['message' => 'Product deleted successfully.']);
        }
        if ($type == "status") {
            $product->status = $product->status == 1 ? 0 : 1;
            $product->save();
            return redirect()->back()->with(['message' => 'Status changed successfully.']);
        }
        return abort(404);
    }

    public function productAttribute(Request $request)
    {
        $categories = Category::where('deleted', 0)->get();
        foreach ($categories as $category) {
            $category->subcategories = Subcategory::where(['category_id' => $category->id, 'deleted' => 0])->get();
            foreach ($category->subcategories as $subcategory) {
                $subcategory->products = Product::where(['subcategory_id' => $subcategory->id, 'deleted' => 0])->get();
            }
            $category->products = Product::where(['category_id' => $category->id, 'deleted' => 0])->get();
        }

        $attributes = ProductAttribute::where('deleted', 0)->get();
        foreach ($attributes as $attribute) {
            $attribute->details = Attribute::where('id', $attribute->attribute_id)->first();
        }
        $types = Attribute::where('deleted', 0)->get();
        return view('Admin.product.attribute.index', compact('categories', 'attributes', 'types'));
    }

    public function productImageDelete($id)
    {
        $image =   ProductImage::where('id', $id)->first();
        if ($image) {
            File::delete(public_path($image->slug_en));
            File::delete(public_path($image->slug_fr));
            File::delete(public_path($image->slug_it));
            File::delete(public_path($image->slug_de));
            ProductImage::where('id', $id)->delete();
        }
        return redirect()->back();
    }
    public function productSave(Request $request)
    {

        if (!$request->id) {
            $this->validate($request, [
                'category_id' => 'required',
                'name_en' => 'required',
                'name_fr' => 'required',
                'name_de' => 'required',
                'name_it' => 'required',
                'slug_en' => 'required',
                'slug_fr' => 'required',
                'slug_de' => 'required',
                'slug_it' => 'required',
                'images' => 'required'
            ]);
            $product = new Product();
            $msg = "Product saved successfully";
        } else {
            $this->validate($request, [
                'category_id' => 'required',
                'name_en' => 'required',
                'name_fr' => 'required',
                'name_de' => 'required',
                'name_it' => 'required',
                'slug_en' => 'required',
                'slug_fr' => 'required',
                'slug_de' => 'required',
                'slug_it' => 'required',
                // 'order' => 'required'
            ]);

            $product = Product::findOrFail($request->id);

            if ($product->deleted == 1) {
                return abort(404);
            }
            $msg = "Product updated successfully";
        }

        $category = Category::findOrFail($request->category_id);
        if ($category->deleted == 1) {
            return abort(404);
        }
        if ($request->subcategory_id) {
            $subcategory = Subcategory::findOrFail($request->subcategory_id);
            if ($subcategory->deleted == 1) {
                return abort(404);
            }
        }


        try {

            $arr = ['en', 'it', 'fr', 'de'];

            foreach ($arr as $local) {
                if (!$request->id) {
                    $already = $already = Product::where('slug_' . $local, $request['slug_' . $local])->count();
                    if ($already > 0) {
                        $request['slug_' . $local] = (Product::orderBy('id','DESC')->first()->id + 1) . '-' . $request['slug_' . $local];
                    }
                } else {
                    if ($request['slug_' . $local] != $product['slug_' . $local]) {
                        $already = $already = Product::where('slug_' . $local, $request['slug_' . $local])->count();
                        if ($already > 0) {
                            $request['slug_' . $local] = (Product::orderBy('id','DESC')->first()->id + 1) . '-' . $request['slug_' . $local];
                        }
                    }
                }
            }





            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->name_en = $request->name_en;
            $product->name_fr = $request->name_fr;
            $product->name_de = $request->name_de;
            $product->name_it = $request->name_it;
            $product->slug_en = $request->slug_en;
            $product->slug_fr = $request->slug_fr;
            $product->slug_de = $request->slug_de;
            $product->slug_it = $request->slug_it;
            $product->meta_title_en = $request->meta_title_en;
            $product->meta_title_fr = $request->meta_title_fr;
            $product->meta_title_de = $request->meta_title_de;
            $product->meta_title_it = $request->meta_title_it;
            $product->meta_content_en = $request->meta_content_en;
            $product->meta_content_fr = $request->meta_content_fr;
            $product->meta_content_de = $request->meta_content_de;
            $product->meta_content_it = $request->meta_content_it;
            $product->meta_keyword_en = $request->meta_keyword_en;
            $product->meta_keyword_fr = $request->meta_keyword_fr;
            $product->meta_keyword_de = $request->meta_keyword_de;
            $product->meta_keyword_it = $request->meta_keyword_it;
            $product->save();

            $images = ProductImage::where('id', $product->id)->count();
            if ($images > 0) {
                $count = $images + 1;
            } else {
                $count = 1;
            }

            if ($request->images) {
                foreach ($request->images as $image) {
                    $latest = ProductImage::orderBy('id','DESC')->first();
                    if ($latest) {
                        $number = $latest->id + 1;
                    } else {
                        $number = 1;
                    }
                    $images = null;
                    $upload = [];
                    $upload['slug_en'] = null;
                    $upload['slug_fr'] = null;
                    $upload['slug_it'] = null;
                    $upload['slug_de'] = null;
                    foreach ($arr as $local) {
                        $filename =  preg_replace('/\s+/', '-', $request['slug_' . $local]) . '-' . $number . '.' . $image->getClientOriginalExtension();
                        $destination = '/products/' . $local . '/' . $filename;
                        File::delete(public_path('/storage/products/' . $local . '/' . $filename));
                        if (!$images) {
                            $image->move(public_path() . '/storage/products/' . $local . '/', $filename);
                            $images = $destination;
                        } else {
                            Storage::disk('public')->copy($images, $destination);
                        }

                        $upload['slug_' . $local] = '/storage/products/' . $local . '/' . $filename;
                    }

                    $prodImg = new ProductImage();
                    $prodImg->product_id = $product->id;
                    $prodImg->slug_en = $upload['slug_en'];
                    $prodImg->slug_de = $upload['slug_de'];
                    $prodImg->slug_fr = $upload['slug_fr'];
                    $prodImg->slug_it = $upload['slug_it'];
                    $prodImg->sort = $count;
                    $prodImg->save();
                    $count++;
                }
            }

            $sort = 1;
            if ($request->order) {
                foreach ($request->order as $order) {
                    ProductImage::where('id', $order)->update(['sort' => $sort]);
                    $sort++;
                }
            }

            if (!$request->id) {
                return redirect('/admin/product/attribute?category=' . $product->category_id . '&subcategory=' . $product->subcategory_id . '&product=' . $product->id)->with('success', $msg);
            } else {
                return redirect()->back()->with('success', $msg);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function attribute()
    {
        $attributes = Attribute::where('deleted', 0)->get();
        return view('Admin.attribute.index', compact('attributes'));
    }

    public function attributeCreate()
    {
        return view('Admin.attribute.create');
    }


    public function attributeAction($type, $id)
    {
        $attribute = Attribute::findOrFail($id);

        if ($attribute->deleted == 1) {
            return abort(404);
        }
        if ($type == "edit") {
            return view('Admin.attribute.edit', compact('attribute'));
        }
        if ($type == "delete") {
            $attribute->deleted = 1;
            $attribute->save();
            ProductAttribute::where('attribute_id', $attribute->id)->update(['deleted' => 1]);
            return redirect()->back()->with(['message' => 'Attribute deleted successfully.']);
        }
        if ($type == "status") {
            $attribute->status = $attribute->status == 1 ? 0 : 1;
            $attribute->save();
            ProductAttribute::where('attribute_id', $attribute->id)->update(['status' => 1]);
            return redirect()->back()->with(['message' => 'Status changed successfully.']);
        }
        return abort(404);
    }

    public function attributeSave(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required',
            'name_fr' => 'required',
            'name_de' => 'required',
            'name_it' => 'required',
        ]);

        if (!$request->id) {
            $attribute = new Attribute();
            $msg = "Attribute Added Successfully.";
        } else {
            $attribute = Attribute::findOrFail($request->id);
            $msg = "Attribute Updated Successfully.";
        }

        try {
            $attribute->name_en = $request->name_en;
            $attribute->name_fr = $request->name_fr;
            $attribute->name_it = $request->name_it;
            $attribute->name_de = $request->name_de;
            $attribute->save();
            return redirect()->route('admin.attribute')->with("message", $msg);
        } catch (Exception $e) {

            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function productAttributeSave(Request $request)
    {
        $attribute = Attribute::where(['id' => $request->attribute_id, 'deleted' => 0])->first();
        if (!$attribute) {
            return response()->json(['message' => 'No such attribute found!'], 404);
        }

        $product = Product::where(['id' => $request->product_id, 'deleted' => 0])->first();
        if (!$product) {
            return response()->json(['message' => 'No such product found!'], 404);
        }
        if (!$request->id) {
            $attribute = new ProductAttribute();
        } else {
            $attribute = ProductAttribute::findOrFail($request->id);
            if ($attribute->deleted != 0) {
                return abort(404);
            }
        }
        $attribute->name = $request->name;
        $attribute->price_chf = $request->price_chf;
        $attribute->price_eur = $request->price_eur;
        $attribute->price_usd = $request->price_usd;
        $attribute->price_rub = $request->price_rub;
        $attribute->attribute_id = $request->attribute_id;
        $attribute->product_id = $request->product_id;
        $attribute->save();
        return response()->json(['message' => 'Attribute saved successfully!'], 200);
    }

    public function productAttributeAction($type, $id)
    {
        $attribute = ProductAttribute::findOrFail($id);

        if ($attribute->deleted == 1) {
            return abort(404);
        }
        if ($type == "edit") {
            $product = Product::findOrFail($attribute->product_id);
            if ($product->deleted == 1) {
                return abort(404);
            }
            $product->attributes = ProductAttribute::where(['attribute_id' => $attribute->attribute_id, 'deleted' => 0])->get();
            $product->attribute = Attribute::where(['deleted' => 0, 'id' => $attribute->attribute_id])->first();
            $attributes = Attribute::where('deleted', 0)->get();
            return view('Admin.product.attribute.edit', compact('product', 'attributes'));
        }
        if ($type == "delete") {
            $attribute->deleted = 1;
            $attribute->save();
            return redirect()->back()->with(['message' => 'Product Attribute deleted successfully.']);
        }
        if ($type == "status") {
            $attribute->status = $attribute->status == 1 ? 0 : 1;
            $attribute->save();
            return redirect()->back()->with(['message' => 'Status changed successfully.']);
        }
        return abort(404);
    }
}
