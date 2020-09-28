<?php

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

//vue router

Route::view('/home','home');
Route::view('/','login');
Route::view('/signups','Signup');
Route::get('/reset-password/{token}','AuthmailController@gettingtoken');
Route::view('/checking_signup','checking_signup');
Route::view('/{any}','home');
Route::view('/{any}/{any1}','home');
Route::view('/{any}/{any1}/{any2}','home');
Route::view('/{any}/{any1}/{any2}/{any3}','home');
Auth::routes();

