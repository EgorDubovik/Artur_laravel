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
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\TransactionViewController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\PriceListController;
use App\Http\Controllers\Admin\UserTableController;
use App\Http\Controllers\Admin\RandomController;

Route::get('/', function(){
	return redirect("login");
});
Route::get("/random",function(Request $request){
	$links = [
		['link1',40,0],
		['link2',60,0],
		
		
	];
	$array_ver = [0];
	foreach ($links as $key => $link) {
		$array_ver[]=$array_ver[count($array_ver)-1]+$link[1];
	}
	for($i=0;$i<=100;$i++)
	{
		$random_number = rand(0,$array_ver[count($array_ver)-1]);
		for ($j=1; $j < count($array_ver); $j++) { 
			if($random_number>$array_ver[$j-1] && $random_number<=$array_ver[$j])
			{
				$links[$j-1][2]++;
			}
		}
	}

	echo "<per>";
	print_r($links);
	echo "</per>";
});


Route::get('/login',[LoginController::class,'login'])->name("login");
Route::post('/actionLogin',[LoginController::class,'actionLogin']);
Route::get("/logout",[LoginController::class,'logOut']);
Route::get("/signup",[RegisterController::class,'view']);
Route::post("/signup",[RegisterController::class,'create']);
Route::get("/code",[LoginController::class,'enterCode'])->name("code");
Route::post("/code",[LoginController::class,'enterCode']);
Route::get("/resendcode",[LoginController::class,'resendcode']);
Route::get("/forgotpassword",[LoginController::class,'forgotpassword'])->name('forgotpassword');
Route::post("/sendlink",[LoginController::class,'sendlink']);
Route::get("/resetpass/{code}",[LoginController::class,'restpass']);
Route::post("/restpass/{code}",[LoginController::class,'restpass']);

Route::group(['middleware' => ['auth']], function () {
	Route::group(['middleware'=>['admin'],'prefix'=>'admin'],function(){

		//Users
		Route::get('/users',[UserController::class,'viewAllUsers']);
		Route::get('/addNewUser',[UserController::class,'viewForm'])->name('new.user.form');
		Route::post('/addNewUser',[UserController::class,'store'])->name('new.user.store');
		Route::delete('/users/remove/{id}',[UserController::class,'diactivateUser']);
		Route::get('/user/{id}',[UserController::class,'viewUserInfo']);

		//Payments
		Route::get('/makepayment/{id}',[PaymentController::class,'index'])->name('payment.form');
		Route::get("/removePayment/{paymentId}",[PaymentController::class,'removePayment']);
		Route::post('/save',[PaymentController::class,'saveNewPayment']);

		//PriceList
		Route::get('/pricelist',[PriceListController::class,'pricelist'])->name('price.list');
		Route::get('/pricelist/remove/{id}',[PriceListController::class,'remove']);
		Route::post('/pricelist/edit',[PriceListController::class,'edit']);
			
		// UserTable
		Route::get('/user/table/{id}',[UserTableController::class,'view']);	
		Route::get('/create/table/{id}',[UserTableController::class,'createTableView']);	
		Route::post('/store/table',[UserTableController::class,'store']);
		Route::post('/table/add/line/{table_id}',[UserTableController::class,'addLine']);
		Route::get('/remove/line/{id}',[UserTableController::class,'removeLine']);
		Route::get('/remove/table/{id}',[UserTableController::class,'removeTable']);
		// Random
		Route::get('/random/links',[RandomController::class,'view']);
		Route::post('/random/add',[RandomController::class,'add']);
		Route::post('/random/edit',[RandomController::class,'edit']);
		Route::get('/random/remove/{id}',[RandomController::class,'remove']);
	});
	Route::get("/dashboard",[DashBoardController::class,'dashboard']);
	Route::get("/transaction/{id}",[TransactionViewController::class,'index']);
	Route::post("/getpayment",[DashBoardController::class,'getPay']);
	Route::group(['prefix'=>'account'],function(){
		Route::get("/",[AccountSettingsController::class,'account'])->name("account");
		Route::put("/update",[AccountSettingsController::class,'updateUserInformation']);
		Route::put("/update_pass",[AccountSettingsController::class,'updatePass']);	
	});

	//UserTable
	Route::post("/table/cell/edit",[UserTableController::class,'editCell']);
	Route::get("/table",[App\Http\Controllers\UserTableController::class,"view"]);
	
	
});

