<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Analyze;
use Illuminate\Http\Request;
use App\Http\Controllers\TweetController;

class AnalyzerController extends Controller
{
    function getAnalyze() {
        $users = User::get();
        foreach($users as $user) {
            $analyze = new Analyze;
            $analyze->user_id = $user->id;
            $analyze->follower = $this->follower($user);
            $analyze->following = $this->following($user);
            $analyze->listed = $this->listed($user);
            $analyze->save();
        }
        return;
    }
    private static function follower($user) {
        
        $twitter = TweetScheduleController::makeTwitter();
        //get users
        $twitter->get('users/show', [
            'screen_name' => $user->name
        ]);
        
        return $twitter->followers_count;
    }
    private static function following($user) {
        
        $twitter = TweetScheduleController::makeTwitter();
        //get users
        $twitter->get('users/show', [
            'screen_name' => $user->name
        ]);
        return $twitter->freinds_count;
    }
    private static function listed($user) {
        
        $twitter = TweetScheduleController::makeTwitter();
        //get users
        $twitter->get('users/show', [
            'screen_name' => $user->name
        ]);
        return $twitter->listed;
    }
}
