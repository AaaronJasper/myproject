<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleLoginCallback()
    {
        $user = Socialite::driver('google')->user();
        $existUser = User::where('email', $user->email)->first();
        $findUser = User::where('google_account', $user->id)->first();

        if ($findUser) {
            Auth::login($findUser,true);
            return redirect()->intended('dashboard');
        }
        //如果會員資料庫中沒有 Google 帳戶資料，將檢查資料庫中有無會員 email，如果有僅加入 Google 帳戶資料後導向主控台
        if ($existUser != '' && $existUser->email === $user->email) {
            $existUser->google_account = $user->id;
            $existUser->save();
            Auth::login($existUser,true);
            return redirect()->intended('dashboard');
        } else {
            //資料庫無會員資料時註冊會員資料，然後導向主控台
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_account' => $user->id,
                'password' => encrypt('fromsocialwebsite'),
            ]);
            Auth::login($newUser,true);
            return redirect()->intended('dashboard');
        }
    }
}
