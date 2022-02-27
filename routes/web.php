<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('chats.index');
});

Route::group(['middleware'=>'auth'], function () {
    Route::post('/logout', 'AuthController@logout')->name('logout');
    Route::get('/chats', 'ChatsController@index')->name('chats.index');
    Route::post('/chats', 'ChatsController@store')->name('chats.store');
    Route::get('/chats/{chatID}', 'ChatsController@show')->name('chats.show');
    Route::delete('/chats/{chatID}', 'ChatsController@destroy')->name('chats.destroy');
    Route::post('/chats/{chatID}/messages', 'MessagesController@store')->name('messages.store');
    Route::delete('/chats/{chatID}/messages/{messageID}', 'MessagesController@destroy')->name('messages.destroy');

});

Route::group(['middleware' => 'guest'], function(){
    Route::get('/login', 'AuthController@loginForm')->name('loginForm');
    Route::post('/login', 'AuthController@login')->name('login');
    Route::get('/register', 'AuthController@registerForm')->name('registerForm');
    Route::post('/register', 'AuthController@register')->name('register');
});