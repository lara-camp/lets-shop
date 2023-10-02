<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function loginView()
    {
        return Inertia::render('Auth/Admin/AdminLogin', [
            'status' => session('status') ?? null,
        ]);
    }

    public function login(Request $request)
    {
        // Validate the request parameters
        $validated = $request->validate([
            'email'    => 'required|max:30|email|exists:users,email',
            'password' => 'required|min:8|max:15',
        ], [
            'email.exists' => 'email or password is incorrect',
        ]);
        $user = User::where('email', $request->email)->first();

        // Check if the password matches
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('admin.loginView')
                ->withErrors(['email' => "email or password is incorrect"]);
        }
         // Check user role if password match (Redirect if is not authorized role)
        if ($user->role === "user") {
            return redirect()->back()->with('status', 'You are not authorized to access this page');
        }
        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }
}
