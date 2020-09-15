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
            $this->isAdmin($socialUser->getEmail());
            //idが変更されてないかチェック
            if($socialUser->getNickname() != $user->name) {
                $user->name = $socialUser->getNickname();
                $user->save();
            }
            Auth::login($user);
            return redirect('/home');
        }

        $this->isAdmin($socialUser->getEmail());
        $user->email = $socialUser->getEmail();
        $user->name = $socialUser->getNickname();
        $user->access_token = $socialUser->token;
        $user->access_token_secret = $socialUser->tokenSecret;
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public static function isAdmin($email) {
        switch ($email) {
            case config('app.twitter1'):
                $status = false;
                break;
            case config('app.twitter2'):
                $status = false;
                break;
            case config('app.twitter3'):
                $status = false;
                break;
            case config('app.twitter4'):
                $status = false;
                break;
            case config('app.twitter5'):
                $status = false;
                break;
            default: 
                abort('403');
                return false;
        }
        return $status;
    }
}
