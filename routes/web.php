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

Route::get('/login',"Auth\LoginController@login")->name("login");
Route::post('/actionLogin',"Auth\LoginController@actionLogin");
Route::get("/logout","Auth\LoginController@logOut");
Route::get("/signup","Auth\LoginController@signup");
Route::post("/signup","Auth\LoginController@signup");
Route::get("/code","Auth\LoginController@enterCode")->name("code");
Route::post("/code","Auth\LoginController@enterCode");
Route::get("/resendcode","Auth\LoginController@resendcode");
Route::get("/forgotpassword","Auth\LoginController@forgotpassword")->name('forgotpassword');
Route::post("/sendlink","Auth\LoginController@sendlink");
Route::get("/resetpass/{code}","Auth\LoginController@resetpass");
Route::post("/resetpass/{code}","Auth\LoginController@resetpass");

Route::group(['middleware' => ['auth']], function () {
	Route::group(['middleware'=>['admin'],'prefix'=>'admin'],function(){

		//Users
		Route::get('/users',"Admin\UserController@viewAllUsers");
		Route::get('/addNewUser','Admin\UserController@viewForm')->name('new.user.form');
		Route::post('/addNewUser','Admin\UserController@store')->name('new.user.store');
		Route::delete('/users/remove/{id}','Admin\UserController@diactivateUser');
		Route::get('/user/{id}','Admin\UserController@viewUserInfo');

		//Payments
		Route::get('/makepayment/{id}','Admin\PaymentController@index')->name('payment.form');
		Route::get("/removePayment/{paymentId}","Admin\PaymentController@removePayment");
		Route::post('/save','Admin\PaymentController@saveNewPayment');

		//PriceList
		Route::get('/pricelist','Admin\PriceListController@pricelist')->name('price.list');
		Route::get('/pricelist/remove/{id}','Admin\PriceListController@remove');
		Route::post('/pricelist/edit','Admin\PriceListController@edit');
		
	});
	Route::get("/dashboard","DashBoardController@dashboard");
	Route::get("/transaction/{id}","TransactionViewController@index");
	Route::post("/getpayment","DashBoardController@getPay");
	Route::group(['prefix'=>'account'],function(){
		Route::get("/","AccountSettingsController@account")->name("account");
		Route::put("/update","AccountSettingsController@updateUserInformation");
		Route::put("/update_pass","AccountSettingsController@updatePpass");	
	});
	
	
});

