<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Http\Controllers\TweetController;
use Auth;

class TweetScheduleController extends Controller
{
    function create(Request $req) {
        $validatedData = $req->validate([
            'content' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        $schedule = new Schedule;
        $schedule->user_id = Auth::user()->id;
        $schedule->tweetdate = $req->date;
        $schedule->tweettime = $req->time;
        $schedule->content = $req->content;
        $schedule->save();
        session()->flash('flash_message', '予約に成功した。');
        return back();
    }

    public static function tweet() {
        $tweets = Schedule::where('tweetdate', date('Y-m-d'))->where('tweettime', date('H'))->get();
        foreach($tweets as $tweet) {
            //user find
            $user = User::where('id', $tweet->user_id)->first();
            //twitter setup
            $twitter = TweetScheduleController::makeTwitter();
            //Tweeeeeeeeeeted!!!!!!!
            $res = get_object_vars($twitter->post("statuses/update", [
                "status" => $tweet->content
            ]));
            $tweet->delete();
            Log::debug('予約投稿ed'. $res);
        }
        return;
    }
}
