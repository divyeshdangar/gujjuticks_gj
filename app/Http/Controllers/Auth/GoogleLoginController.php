<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
        if (!$user) {
            $data = [
                'name' => $googleUser->name, 
                'email' => $googleUser->email, 
                'token' => $googleUser->token, 
                'profile' => $googleUser->avatar, 
                'social_id' => $googleUser->id, 
                'login_type' => 'GL',
                'password' => \Hash::make(rand(100000, 999999))
            ];
            $user = User::create($data);
        }
        Auth::login($user);
        return redirect()->route('dashboard')->with('message', 'Login successfully!');
    }
}
