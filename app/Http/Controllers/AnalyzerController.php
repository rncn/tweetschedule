<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Analyze;
use Illuminate\Http\Request;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetScheduleController;

class AnalyzerController extends Controller
{
    public static function getAnalyze() {
        $user_model = new User;
        $users = $user_model->get();
        foreach($users as $user) {
            $analyze = new Analyze;
            $analyze->user_id = $user->id;
            $analyze->follower = self::follower($user);
            $analyze->following = self::following($user);
            $analyze->listed = self::listed($user);
            $analyze->save();
        }
        return;
    }
    private static function follower($user) {
        $twitter = TweetController::makeTwitter($user->id);
        //get users
        $twd =json_decode($twitter->get('users/show', [
            'screen_name' => $user->name
        ]));
        
        return $twd['followers_count'];
    }
    private static function following($user) {

        $twitter = TweetController::makeTwitter($user->id);
        //get users
        $twd = json_decode($twitter->get('users/show', [
            'screen_name' => $user->name
        ]));
        return $twd['freinds_count'];
    }
    private static function listed($user) {
        
        $twitter = TweetController::makeTwitter($user->id);
        //get users
        $twd =json_decode($twitter->get('users/show', [
            'screen_name' => $user->name
        ]));
        return $twd['listed_count'];
    }
}
