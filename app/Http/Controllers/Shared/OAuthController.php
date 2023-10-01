<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class OAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
        ], [
            'name'      => $googleUser->name,
            'email'     => $googleUser->email,
            'google_id' => $googleUser->id,
            'password'  => Hash::make("yngWIE500"),
            'avatar'    => $googleUser->avatar ?? '',
            'role'      => 'user',
        ]);
        $user->markEmailAsVerified();
        Auth::login($user);

        return redirect()->route('page.home');
    }

}
