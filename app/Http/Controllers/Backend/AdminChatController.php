<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminChatController extends Controller
{

    public function view()
    {
        return Inertia::render('Backend/Message/Index');
    }
}
