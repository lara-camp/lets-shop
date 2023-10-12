<?php

namespace App\Http\Controllers\Backend\Page;

use App\Models\HotSlide;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Carbon\Carbon;

class HotSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Summary of index
     * @param \Illuminate\Http\Request $request
     * @param mixed $delete
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $slides =  $request->input('action') == 1
            ? HotSlide::latest()->get()
            : Inertia::lazy(fn () => HotSlide::latest()->get());

        return Inertia::render('Backend/Page/Hotslide/Index', [
            'slides' => $slides,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Backend/Page/Hotslide/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'required|mimes:png,jpg,jpeg,svg',
        ]);

        $files = [];
        if ($request->file('files')) {
            foreach ($request->file('files') as $key => $file) {
                $fileName = time() . rand(1, 99) . '-' . Carbon::now()->format('Y_m_d_H_i_s') . '.' . $file->extension();
                $file->move(public_path('hot-slide'), $fileName);
                $files[]['name'] = $fileName;
            }
        }

        foreach ($files as $file) {
            HotSlide::create([
                'image' => $file['name']
            ]);
        }

        return redirect()->route('hot-slide.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(HotSlide $hotSlide)
    {
        return json_encode($hotSlide);
    }

    /**
     * Update the specified resource in storage.
     */
    public function isShow(Request $request)
    {
        $hotSlide = HotSlide::find($request->id);
        $hotSlide->is_show = $hotSlide->is_show == '1' ? '0' : '1';
        $hotSlide->update();
        return redirect()->route('hot-slide.index', ['action' => 1]);
    }

    public function customUpdate(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'required|mimes:png,jpg,jpeg,svg',
        ]);
        $hotSlide = HotSlide::find($request->id);

        $file = $request->file('files')[0];
        $fileName = time() . rand(1, 99) . '-' . Carbon::now()->format('Y_m_d_H_i_s') . '.' . $file->extension();
        $file->move(public_path('hot-slide'), $fileName);

        // if (File::exists(public_path('hot-slide/' . $hotSlide->image))) {
        //     unlink(public_path('hot-slide/' . $hotSlide->image));
        // }
        if (File::exists(public_path('hot-slide/' . $hotSlide->image))) {
            unlink(public_path('hot-slide/' . $hotSlide->image));
        }
        $hotSlide->update(['image' => $fileName]);
        return redirect()->route('hot-slide.index', ['action' => 1]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HotSlide $hotSlide)
    {
        if (File::exists(public_path('hot-slide/' . $hotSlide->image))) {
            unlink(public_path('hot-slide/' . $hotSlide->image));
            $hotSlide->delete();
        }
        return redirect()->route('hot-slide.index', ['action' => 1]);
    }
}
