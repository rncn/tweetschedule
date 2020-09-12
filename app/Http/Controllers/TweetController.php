<?php

namespace App\Http\Controllers;

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
}
