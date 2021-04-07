<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Payments;
use App\Service;
use App\Prefix;
use App\UserServices;
use Auth;
use EmailHelper;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserController extends Controller
{

	public function viewForm(Request $request)
	{	
		$services = Service::whereNull('id_service')->get();
		return view("admin.add_user")->with(['services'=>$services]);
	}

	public function viewAllUsers(Request $request)
	{
		
		$users = User::where([["id","<>",Auth::user()->id],['id','<>',1],['confirmed',1]])->orderBy("id",'desc')->get();

		return view("admin.users")->with(["users"=>$users]);
	}

	public function diactivateUser(Request $request,$id)
	{
		$user = User::find($id);
		$user->confirmed = 0;
		$user->save();
		return redirect('admin/users')->with('success','Diactivate user saccessful');
	}

	public function viewUserInfo(Request $request,$id)
	{
		$user = User::find($id);
		return view("admin.user")->with(["user"=>$user]);
	}

	public function store(Request $request)
	{
		$status = "error";
		$errorMes = "";
		if(!is_null($request->email)){
			$messages = [
                'first_name.required' => 'The First name field is required.',
                'last_name.required' => 'The Last name field is required.',
                'password.required' => 'The Password field is required.',
                
            ];
            $input = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ],$messages);
			$user = User::create([
				'first_name' => $request->first_name,
				'last_name'	=> $request->last_name,
				'email' => $request->email,
				'phone_number' => null,
				'confirmed'=>1,
				'description'=>$request->description,
				'shops'=>$request->shops,
				'password' => password_hash($request->password, PASSWORD_BCRYPT),
				'is_admin' => ($request->has("admin")) ? 1 : 0,
			]);
			if($user->save()){
				$status = "success";
				$errorMes = "New user save successfull";
				EmailHelper::sendNewUserInformation($user,$request->password);
			} else {
				$errorMes = "Somthing went wrong. Please trye again later";
			}
		}
		if(!is_null($request->service) && count($request->service)>0){
			$amount = 0;
			foreach ($request->services as $in => $ser) {
				$srv = Service::find($ser);
				$amount += $srv->price*$request->count[$in];
			}
			$payment = Payments::create([
				'user_id'=>$user->id,
				'amount' => $amount,
				'status' => Payments::PENDING,
			]);

			foreach ($request->service as $in => $serv) {
				UserServices::create([
					'id_service'=>$serv,
					'id_payment'=>$payment->id,
					'count'=>$request->count[$in],
				]);
			}
		}

		return redirect()->route('new.user.form')->with([$status=>$errorMes]);

	}
}