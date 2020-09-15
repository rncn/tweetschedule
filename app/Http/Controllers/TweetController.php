<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use Auth;

class TweetController extends Controller
{
    function nowTweet(Request $req) {
        $twitter = new TwitterOAuth(env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            Auth::user()->access_token,
            Auth::user()->access_token_secret);
        $res = get_object_vars($twitter->post("statuses/update", [
            "status" => $req->tweet
        ]));
        session()->flash('flash_message', http_build_query($res));
        return back();
    }
    public static function makeTwitter($userid) {
        //getuser
        $user_model = new User;
        $user = $user_model->where('id', $userid)->first();

        return $twitter = new TwitterOAuth(env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET'),
            $user->access_token,
            $user->access_token_secret);
    }
}
