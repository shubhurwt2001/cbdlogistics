<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Faq;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('Admin.dashboard');
    }

    // banner------------------------------------------
    public function banner()
    {
        $banners = Banner::all();
        return view('Admin.banner.index', compact('banners'));
    }

    public function bannerCreate()
    {
        return view('Admin.banner.create');
    }

    public function bannerSave(Request $request)
    {
        if (!$request->id) {
            $this->validate($request, [
                'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
            ]);
            $banner = new Banner();
            $msg = "Banner Added Successfully.";
        } else {
            $banner = Banner::findOrFail($request->id);
            $msg = "Banner updated Successfully.";
        }
        try {
            $banner->title_en = $request->title_en;
            $banner->title_fr = $request->title_fr;
            $banner->title_it = $request->title_it;
            $banner->title_de = $request->title_de;
            $banner->alt_en = $request->alt_en;
            $banner->alt_fr = $request->alt_fr;
            $banner->alt_it = $request->alt_it;
            $banner->alt_de = $request->alt_de;
            $banner->description_en = $request->desc_en;
            $banner->description_fr = $request->desc_fr;
            $banner->description_it = $request->desc_it;
            $banner->description_de = $request->desc_de;

            if ($request->hasFile('image')) {
                $name = $request->image->getClientOriginalName();
                $filename =  date('ymdgis') . $name;
                $request->image->move(public_path() . '/storage/banner/', $filename);
                $banner->url = '/storage/banner/' . $filename;
            }

            $banner->save();

            return redirect()->route('admin.banner')->with("message", $msg);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function bannerAction($type, $id)
    {
        $banner = Banner::findOrFail($id);
        if ($type == "edit") {
            return view('Admin.banner.edit', compact('banner'));
        }
        if ($type == "delete") {
            Banner::where('id', $id)->delete();
            return redirect()->back()->with(['message' => 'Banner deleted successfully.']);
        }
        if ($type == "status") {
            $banner->status = $banner->status == 1 ? 0 : 1;
            $banner->save();

            return redirect()->back()->with(['message' => 'Status changed successfully.']);
        }
        return abort(404);
    }

    // banner end------------------------------------------

    //FAQ--------------------------------------------------
    public function faq()
    {
        $faqs = Faq::orderBy('id', 'ASC')->get();
        return view('Admin.faq.index', compact('faqs'));
    }

    public function faqCreate()
    {
        return view('Admin.faq.create');
    }

    public function faqSave(Request $request)
    {
        $this->validate($request, [
            'question_en' => 'required',
            'question_fr' => 'required',
            'question_de' => 'required',
            'question_it' => 'required',
            'answer_en' => 'required',
            'answer_fr' => 'required',
            'answer_it' => 'required',
            'answer_de' => 'required',

        ]);

        if (!$request->id) {
            $faq = new Faq();
            $msg = "FAQ Added Successfully.";
        } else {
            $faq = Faq::findOrFail($request->id);
            $msg = "FAQ Updated Successfully.";
        }

        // dd($request->all());
        try {
            $faq->question_en = $request->question_en;
            $faq->question_fr = $request->question_fr;
            $faq->question_it = $request->question_it;
            $faq->question_de = $request->question_de;
            $faq->answer_en = $request->answer_en;
            $faq->answer_fr = $request->answer_fr;
            $faq->answer_it = $request->answer_it;
            $faq->answer_de = $request->answer_de;
            $faq->save();
            return redirect()->route('admin.faq')->with("message", $msg);
        } catch (Exception $e) {

            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function faqAction($type, $id)
    {
        $faq = Faq::findOrFail($id);
        if ($type == "edit") {
            return view('Admin.faq.edit', compact('faq'));
        }
        if ($type == "delete") {
            Faq::where('id', $id)->delete();
            return redirect()->back()->with(['message' => 'FAQ deleted successfully.']);
        }
        if ($type == "status") {
            $faq->status = $faq->status == 1 ? 0 : 1;
            $faq->save();
            return redirect()->back()->with(['message' => 'Status changed successfully.']);
        }
        return abort(404);
    }
    //FAQ end------------------------------------------------
}
