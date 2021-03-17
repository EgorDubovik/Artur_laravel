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
		Route::get('/users',"Admin\AdminController@listUsers");
		Route::get('/addNewUser','Admin\AdminController@addNewUser');
		Route::post('/addNewUser','Admin\AdminController@addNewUser');
		Route::delete('/users/remove/{id}','Admin\AdminController@removeUser');
		Route::get('/user/{id}','Admin\AdminController@viewUserInfo');
		Route::get('/makepayment/{id}','Admin\AdminController@makepayment');
		Route::post('/makepayment/{id}','Admin\AdminController@makepayment');
		Route::get('/pricelist','Admin\PriceListController@pricelist');
		Route::get('/pricelist/remove/{id}','Admin\PriceListController@pricelistRemove');
		Route::get("/admin/user/removePayment/{id}/{pid}","Admin\AdminController@removePayment");
	});
	Route::get("/dashboard","DashBoardController@dashboard");
	Route::group(['prefix'=>'account'],function(){
		Route::get("/","AccountController@account")->name("account");
		Route::put("/update","AccountController@update_user_info");
		Route::put("/update_pass","AccountController@update_pass");	
	});
	
	Route::post("/getpayment","AccountController@getPay");
});

