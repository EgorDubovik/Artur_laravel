<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payments;
use App\Service;
use App\Prefix;
use App\UserServices;
use Auth;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminController extends Controller
{
    
	public function addNewUser(Request $request){
		$event = false;
		$error = true;

		if(isset($request->event)){
			$event = true;
			if($request->event=="add_new_user"){
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
						$error = false;
						$this->sendEmail($user,$request->password);
					}
				}
				if(!is_null($request->service) && count($request->service)>0){
					$amount = 0;
					foreach ($request->service as $in => $ser) {
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
				
			}
		}

		$services = Service::whereNull('id_service')->get();

		return view("admin.add_user")->with(['event'=>$event,'error'=>$error,'services'=>$services]);
	}

	public function listUsers(Request $request){
		
		$users = User::where([["id","<>",Auth::user()->id],['id','<>',1],['confirmed',1]])->orderBy("id",'desc')->get();

		foreach ($users as $user) {
			$payments = Payments::where("user_id",$user->id)->get();

			$amount = 0;
			foreach ($payments as $payment) {
				$amount+=$payment->amount;
			}
			$user->samary = number_format($amount/100,2);
		}
		
		return view("admin.users")->with(["users"=>$users]);
	}

	private function sendEmail($user,$pass){
		$temp = 'Уважаемый, '.$user->first_name.' '.$user->last_name.'<br>
				Вы зарегистрированы в качестве партнера на сайте "just-prep.com"<br>
				Высылаем Вам ваши логин и пароль, которые Вы сможете ввести в соответствующую форму на нашем сайте: account.just-prep.com <br><br>
				Логин: '.$user->email.'<br> Пароль: '.$pass.'<br><br>
				Искренне ваши JBS Group LLC!<br><br>

				Если это письмо пришло к Вам по ошибке - пожалуйста, проигнорируйте его.<br>
				Спасибо!';
		$mail = new PHPMailer(true);
		$mail->isSMTP();                                            
		$mail->Host       = env('MAIL_HOST');
		$mail->SMTPAuth   = true;                                   
		$mail->Username   = env('MAIL_USERNAME');
		$mail->Password   = env('MAIL_PASSWORD');                               
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
		$mail->Port       = env('MAIL_PORT');                   
		try {
		    $mail->setFrom('justprepcenter@gmail.com', 'JBS Group LLC');
		    $mail->addAddress($user->email);
		    $mail->isHTML(true);                                  
		    $mail->Subject = 'Sending from just-prep';
		    $mail->Body    = $temp;
		    $mail->send();
		    return true;
		} catch (Exception $e) {
		   	return false;
		}

	}

	public function removeUser(Request $request,$id){
		$user = User::find($id);
		$user->confirmed = 0;
		$user->save();
		return redirect('admin/users')->with('success','Diactivate user saccessful');
	}

	public function viewUserInfo(Request $request,$id){
		$user = User::find($id);
		return view("admin.user")->with(["user"=>$user]);
	}

	public function makepayment(Request $request,$id){
		$user = User::find($id);
		$is_event = false;
		$event_error = false;
		if(isset($request->event)){
			if($request->event=="new_payment"){
				if(count($request->service)>0){
					$amount = 0;
					foreach ($request->service as $in => $ser) {
						
						$srv = Service::find($ser);
						if($srv)
							$amount += $srv->price*$request->count[$in];
					}
					

					$payment = Payments::create([
						'user_id'=>$request->user_id,
						'amount' => $amount,
						'status' => Payments::PENDING,
					]);

					foreach ($request->service as $in => $serv) {
						if(is_numeric($serv))
							UserServices::create([
								'id_service'=>$serv,
								'id_payment'=>$payment->id,
								'count'=>$request->count[$in],
							]);
					}

					$is_event = true;
				}
			}
		}

		$services = Service::whereNull('id_service')->get();
		return view("admin.makepayment")->with(["user"=>$user,"services"=>$services,"is_event"=>$is_event]);
	}
	
	public function removePayment(Request $request,$user_id,$payment_id)
	{
		$payment = Payments::find($payment_id);
		foreach ($payment->userServices as $service) {
			$service->delete();
		}
		$payment->delete();
		return redirect("admin/user/".$user_id);
	}

}
