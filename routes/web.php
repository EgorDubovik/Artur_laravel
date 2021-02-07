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

Route::get('/', function(){
	return redirect("login");
	//return view("coming");
});

Route::get('/login',"LoginController@login")->name("login");
Route::post('/actionLogin',"LoginController@actionLogin");
Route::get("/logout","LoginController@logOut");
Route::get("/signup","LoginController@signup");
Route::post("/signup","LoginController@signup");
Route::get("/code","LoginController@enterCode")->name("code");
Route::post("/code","LoginController@enterCode");
Route::get("/resendcode","LoginController@resendcode");
Route::get("/resetpassword","LoginController@resetpassword");
Route::post("/resetpassword","LoginController@resetpassword");
Route::get("/restpass/{code}","LoginController@restpass");
Route::post("/restpass/{code}","LoginController@restpass");

Route::group(['middleware' => ['auth']], function () {
	Route::group(['middleware'=>['admin']],function(){
		Route::get('/admin/users',"AdminController@listUsers");
		Route::get("/admin/addNewUser","AdminController@addNewUser");
		Route::post("/admin/addNewUser","AdminController@addNewUser");
		Route::get("/admin/users/remove/{id}","AdminController@removeUser");
		Route::get("/admin/user/{id}","AdminController@viewUserInfo");
		Route::get("/admin/makepayment/{id}","AdminController@makepayment");
		Route::post("/admin/makepayment/{id}","AdminController@makepayment");
		Route::get("/admin/pricelist","AdminController@pricelist");
		Route::get("/admin/pricelist/remove/{id}","AdminController@pricelistRemove");
		Route::get("/admin/user/removePayment/{id}/{pid}","AdminController@removePayment");
	});
	Route::get("/dashboard","DashBoardController@dashboard");
	Route::get("/account","AccountController@account");
	Route::post("/account","AccountController@account");
	Route::post("/getpayment","AccountController@getPay");
});

