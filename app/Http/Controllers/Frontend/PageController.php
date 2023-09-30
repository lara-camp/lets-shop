<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PageController extends Controller
{
    public function home () {
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
