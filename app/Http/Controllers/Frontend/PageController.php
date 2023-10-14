<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HotSlide;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home () {
//        Auth::logout();
        return Inertia::render('Frontend/Home',[
            'slides' => HotSlide::where('is_show' , '1')->latest()->get()
        ]);
    }
    public function shop () {

    }
    public function category () {

    }
    public function detail () {

    }
    public function flashsale () {

    }
    public function contact () {

    }
}