<?php

namespace App\Http\Controllers\Backend\Page;

use App\Models\HotSlide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class HotSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Backend/Page/Hotslide/Index');
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
        if ($request->file('files')){
            foreach($request->file('files') as $key => $file)
            {
                $fileName = time().rand(1,99).'.'.$file->extension();
                $file->move(public_path('hot-slide'), $fileName);
                $files[]['name'] = $fileName;
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HotSlide $hotSlide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HotSlide $hotSlide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HotSlide $hotSlide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HotSlide $hotSlide)
    {
        //
    }
}
