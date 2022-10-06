<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Exception;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page()
    {
        $pages = Page::all();
        return view('Admin.page.index', compact('pages'));
    }

    public function pageCreate()
    {
        return view('Admin.page.create');
    }

    public function pageSave(Request $request)
    {

        if (!$request->id) {
            $msg = "Page added successfully.";
            $page = new Page();
        } else {
            $page = Page::findOrFail($request->id);
            $msg = "Page updated successfully.";
        }


        $arr = ['en', 'fr', 'de', 'it'];

        foreach ($arr as $local) {
            if ($request['slug_' . $local]) {
                if (!$request->id) {
                    $already = Page::where('slug_' . $local, $request['slug_' . $local])->count();
                    if ($already > 0) {
                        $request['slug_' . $local] = (Page::latest()->first()->id + 1) . '-' . $request['slug_' . $local];
                    }
                } else {
                    if ($request['slug_' . $local] != $page['slug_' . $local]) {
                        $already = Page::where('slug_' . $local, $request['slug_' . $local])->count();
                        if ($already > 0) {
                            $request['slug_' . $local] = (Page::latest()->first()->id + 1) . '-' . $request['slug_' . $local];
                        }
                    }
                }
            }
        }

        try {
            $page->title_en = $request->title_en;
            $page->title_fr = $request->title_fr;
            $page->title_de = $request->title_de;
            $page->title_it = $request->title_it;
            $page->slug_en = $request->slug_en;
            $page->slug_fr = $request->slug_fr;
            $page->slug_de = $request->slug_de;
            $page->slug_it = $request->slug_it;
            $page->meta_title_en = $request->meta_title_en;
            $page->meta_title_fr = $request->meta_title_fr;
            $page->meta_title_de = $request->meta_title_de;
            $page->meta_title_it = $request->meta_title_it;
            $page->meta_content_en = $request->meta_content_en;
            $page->meta_content_fr = $request->meta_content_fr;
            $page->meta_content_de = $request->meta_content_de;
            $page->meta_content_it = $request->meta_content_it;
            $page->meta_keyword_en = $request->meta_keyword_en;
            $page->meta_keyword_fr = $request->meta_keyword_fr;
            $page->meta_keyword_de = $request->meta_keyword_de;
            $page->meta_keyword_it = $request->meta_keyword_it;
            $page->content_en = $request->content_en;
            $page->content_fr = $request->content_fr;
            $page->content_de = $request->content_de;
            $page->content_it = $request->content_it;

            if ($request->in_menu == 1) {
                $page->in_menu = 1;
            } else {
                $page->in_menu = 0;
            }

            if ($request->status == 1) {
                $page->status = 1;
            } else {
                $page->status = 0;
            }

            $page->save();
            return redirect()->route('admin.page')->with("message", $msg);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function pageAction($type, $id)
    {
        $page = Page::findOrFail($id);
        if ($type == "edit") {
            return view('Admin.page.edit', compact('page'));
        }
        if ($type == "delete") {
            Page::where('id', $id)->delete();
            return redirect()->back()->with(['message' => 'Page deleted successfully.']);
        }
        if ($type == "status") {
            $page->status = $page->status == 1 ? 0 : 1;
            $page->save();
            return redirect()->back()->with(['message' => 'Status changed successfully.']);
        }
        return abort(404);
    }
}
