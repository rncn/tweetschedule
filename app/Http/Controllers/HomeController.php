<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    {
        if($req->date == null) {
            $req->date = date('Y-m-d');
        }
        $tweets = Schedule::where('user_id', Auth::user()->id)->where('tweetdate', $req->date)->get();
        $dsotw = $tweets->sortBy('tweettime');

        return view('home', ['tweets' => $dsotw, 'searchdate' => $req->date]);
    }
}
