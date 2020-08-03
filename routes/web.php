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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',"LoginController@login")->name("login");
Route::post('/login',"LoginController@enterPhone");
Route::post("/enterCode","LoginController@enterCode");
Route::get("/logout","LoginController@logOut");
Route::group(['middleware' => ['auth']], function () {
	Route::get("/dashboard","DashBoardController@dashboard");
	Route::get("/account","AccountController@account");
	Route::post("/account","AccountController@account");
});