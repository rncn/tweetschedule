<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SnsLoginController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/social/login', [SnsLoginController::class, 'getAuth'])->name('oauth.login');
Route::get('/social/tw/login', [SnsLoginController::class, 'getAuth'])->name('login');
Route::get('/social/callback', [SnsLoginController::class, 'callback'])->name('oauth.callback');

Route::post('/tweet/now', [TweetController::class, 'nowTweet'])->name('tweetnow')->middleware('auth');
Route::post('/tweet/rev', [TweetScheduleController::class, 'create'])->name('tweet.schedule')->middleware('auth');