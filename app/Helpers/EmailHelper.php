<?php

namespace App\Helpers;
use App\User;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class EmailHelper
{
	
	public static function sendNewUserInformation($user,$pass){
		$temp = 'Уважаемый, '.$user->first_name.' '.$user->last_name.'<br>
				Вы зарегистрированы в качестве партнера на сайте "just-prep.com"<br>
				Высылаем Вам ваши логин и пароль, которые Вы сможете ввести в соответствующую форму на нашем сайте: account.just-prep.com <br><br>
				Логин: '.$user->email.'<br> Пароль: '.$pass.'<br><br>
				Искренне ваши JBS Group LLC!<br><br>

				Если это письмо пришло к Вам по ошибке - пожалуйста, проигнорируйте его.<br>
				Спасибо!';
		
		return self::sendEmail($temp,$user->email);
	}

	public static function sendVerificationCode($email,$code){
		$text = "Email verification code: <b>".$code."</b><br>
                If you received an account verification email in error, it's likely that another user accidentally entered your email while trying to recover their own email account. If you didn't initiate the request, you don't need to take any further action. You can simply disregard the verification email, and the account won't be verified.";
        return self::sendEmail($text,$email);
	}
	public static function sendLinkRestartPassword($email,$link){
		$text = "We have received a request to reset tje password for the just-prep account associated with ".$email." <br><br>You can reset your password by clicking the link below:<br><br><a href='".$link."'>".$link."</a>";
        return self::sendEmail($text,$email);
	}


	public static function sendEmail($temp,$address){
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
		    $mail->addAddress($address);
		    $mail->isHTML(true);                                  
		    $mail->Subject = 'Sending from just-prep';
		    $mail->Body    = $temp;
		    $mail->send();
		    return true;
		} catch (Exception $e) {
		   	return false;
		}
	}
}