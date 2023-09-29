<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function loginView (){
       return Inertia::render('Auth/Admin/AdminLogin');
    }

    public function login (Request $request){
        User::create($request->validate([
            'email' => ['required', 'max:50'],
            'password' => ['required', 'max:50']
        ]));
        return to_route('admin.dasboard');
    }
    public function index(){
        dd("hello world");
    }
}
