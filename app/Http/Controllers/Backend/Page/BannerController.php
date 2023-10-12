<?php

namespace App\Http\Controllers\Backend\Page;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Inertia\Inertia;
use File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Backend/Page/Banner/Banner', [
            'banners' => Banner::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'required|mimes:png,jpg,jpeg,svg',
            'id' => 'required',
            'page' => 'required'
        ]);
        $id = $request->id;
        $page = $request->page;
       $banner = Banner::where('page_section', $id)
        ->where('section', $page)
        ->first();
        $file = $request->file('files')[0];
        $fileName = time() . rand(1, 99) . '-' . Carbon::now()->format('Y_m_d_H_i_s') . '.' . $file->extension();

        $file->move(public_path('banner_img'), $fileName);
        if ($banner) {
            if (File::exists(public_path('banner_img/' . $banner->image))) {
                unlink(public_path('banner_img/' . $banner->image));
            }
            $banner->delete();
            $banner->image = $fileName;
            $banner->section = $page;
            $banner->page_section = $id;
            $banner->save();
        } else {
            Banner::create([
                'image' => $fileName,
                'section' => $page,
                'page_section' => $id
            ]);
        }



        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
