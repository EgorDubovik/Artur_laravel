<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Payments;
use App\Service;
use App\Prefix;

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
				$user = User::create([
					'first_name' => $request->first_name,
					'last_name'	=> $request->last_name,
					'email' => $request->email,
					'phone_number' => null,
					'confirmed'=>1,
					'password' => password_hash($request->password, PASSWORD_BCRYPT),
					'is_admin' => ($request->has("admin")) ? 1 : 0,
				]);
				if($user->save()){
					$error = false;
					$this->sendEmail($user,$request->password);
				}
				if(isset($request->amount)){
					$payment = Payments::create([
						'user_id'=>$user->id,
						'amount' => $request->amount,
						'status' => Payments::PENDING,
					]);

				}
			}
		}


		return view("admin.add_user")->with(['event'=>$event,'error'=>$error]);
	}

	public function listUsers(Request $request){
		
		$users = User::where([["id","<>",Auth::user()->id],['id','<>',1],['confirmed',1]])->orderBy("id",'desc')->get();
		
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
		return redirect('admin/users');
	}

}
