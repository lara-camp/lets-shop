<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home () {
        Auth::logout();
        return Inertia::render('Frontend/Home');
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
