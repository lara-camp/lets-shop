<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;


class AdminAuthController extends Controller
{
    public function loginView()
    {

        if (session()->has('unauthorized_error')) {
            $error = session('unauthorized_error');

        } else {
            $error = null;
        }

        return Inertia::render('Auth/Admin/AdminLogin', [
            'error' => $error,
        ]);

    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|max:30|email|exists:users,email',
            'password' => 'required|min:8|max:15',
        ], [
            'email.exists' => 'email or password is incorrect',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('admin.loginView')
                ->withErrors(['email' => "email or password is incorrect"]);
        }
        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }
}
