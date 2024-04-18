<?php

use Illuminate\Support\Facades\Route;
use Spatie\GoogleCalendar\Event;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('meeting', 'MeetingController@index')->name('meeting');

Route::match(['get','post'],'storemeeting','MeetingController@storeMeeting')->name('store.meeting');

Route::match(['get','post'],'updatemeeting','MeetingController@updateMeeting')->name('update.meeting');

Route::delete('deletemeeting','MeetingController@deleteMeeting')->name('delete.meeting');