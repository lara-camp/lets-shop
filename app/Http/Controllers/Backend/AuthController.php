<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function loginView (){
       return Inertia::render('Auth/Admin/AdminLogin');
    }

    public function login (Request $request){
        $validated = $request->validate([
            'email' => 'required|max:30|email|exists:users,email',
            'password' => 'required|min:8',
        ],[
            'email.exists' => 'email or password is incorrect'
        ]);
        $user = User::where('email',$request->email)->first();
        if(!Hash::check($request->password, $user->password)){
            return redirect()->route('admin.loginView')->withErrors(['email'=>"email or password is incorrect"]);
        }
        return redirect()->route('admin.dashboard');
    }
}
