<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
use App\Models\User;
use Auth;

class SnsLoginController extends Controller
{
     // 1. Socialiteのドライバーにリダイレクトさせる
    public function getAuth() {
        $provider = 'twitter';
        return Socialite::driver($provider)->redirect();
    }

    public function callback() {
        $provider = 'twitter';
        $socialUser = Socialite::driver($provider)->user();
        $user = User::firstOrNew(['email' => $socialUser->getEmail()]);

        // すでに会員になっている場合の処理を書く
        // そのままログインさせてもいいかもしれない
        if ($user->exists) {
            if($socialUser->getEmail() != 'doraidamon1rwfo@outlook.jp'){ 
                abort('403');
                return back();
            }
            Auth::login($user);
            return redirect('/home');
        }

        if($socialUser->getEmail() != 'doraidamon1rwfo@outlook.jp'){ 
            abort('403');
            return back();
        }
        $user->email = $socialUser->getEmail();
        $user->name = $socialUser->getNickname();
        $user->access_token = $socialUser->token;
        $user->access_token_secret = $socialUser->tokenSecret;
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }
}
