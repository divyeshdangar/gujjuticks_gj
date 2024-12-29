<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMenu;
use App\Models\Notification;
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
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();
            $message = [
                "message" => [
                    "type" => "success",
                    "title" => __('dashboard.woow'),
                    "description" => __('dashboard.login_successfully')
                ]
            ];
            if (!$user) {
                $data = [
                    'name' => $googleUser->name, 
                    'first_name' => (isset($googleUser->user) && isset($googleUser->user['given_name']) ? $googleUser->user['given_name'] : ''), 
                    'last_name' => (isset($googleUser->user) && isset($googleUser->user['family_name']) ? $googleUser->user['family_name'] : ''), 
                    'email' => $googleUser->email, 
                    'token' => $googleUser->token, 
                    'profile' => $googleUser->avatar, 
                    'social_id' => $googleUser->id, 
                    'login_type' => 'GL',
                    'password' => \Hash::make(rand(100000, 999999))
                ];
                $user = User::create($data);
                $data = [
                    'message_tag' => 'msg.welcome_new_user',
                    'user_id' => $user->id
                ];
                $message['message']['title'] = "New account created successfully.";
                Notification::create($data);

                $dataDetail = new UserMenu();
                $dataDetail->user_id = $user->id;
                $dataDetail->menuIds = implode(",", [5,9,10,12,20]); // default menus
                $dataDetail->save();

            } else {
                $data = [
                    'message_tag' => 'msg.user_login_success',
                    'user_id' => $user->id
                ];
                Notification::create($data);
            }
            Auth::login($user);
            return redirect()->route('home')->with($message);
        } catch (\Throwable $th) {
            $message = [
                "message" => [
                    "type" => "info",
                    "title" => __('dashboard.wait'),
                    "description" => __('dashboard.login_error')
                ]
            ];
            return redirect()->route('login')->with($message);
        }

    }
}
