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
	Route::group(['middleware'=>['admin'],'prefix'=>'admin'],function(){
		Route::get('/users',"AdminController@listUsers");
		Route::get('/addNewUser','AdminController@addNewUser');
		Route::post('/addNewUser','AdminController@addNewUser');
		Route::get('/users/remove/{id}','AdminController@removeUser');
		Route::get('/user/{id}','AdminController@viewUserInfo');
		Route::get('/makepayment/{id}','AdminController@makepayment');
		Route::post('/makepayment/{id}','AdminController@makepayment');
		Route::get('/pricelist','AdminController@pricelist');
		Route::get('/pricelist/remove/{id}','AdminController@pricelistRemove');
		Route::get("/admin/user/removePayment/{id}/{pid}","AdminController@removePayment");
	});
	Route::get("/dashboard","DashBoardController@dashboard");
	Route::group(['prefix'=>'account'],function(){
		Route::get("/","AccountController@account")->name("account");
		Route::put("/update","AccountController@update_user_info");
		Route::put("/update_pass","AccountController@update_pass");	
	});
	
	Route::post("/getpayment","AccountController@getPay");
});

