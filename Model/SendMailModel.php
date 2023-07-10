<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

 
class SendMailModel
{
	 public function sendMail($param)
    {
        $params = array_change_key_case($param, CASE_LOWER );
		$mail = new PHPMailer;
		$mail->isSMTP(); 
		$mail->SMTPDebug = DEBUG_EMAIL['off']; 
		$mail->Host = EMAIL_HOST; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
		$mail->Port = 587; // TLS only
		$mail->SMTPSecure = 'tls'; // ssl is depracated
		$mail->SMTPAuth = true;
		$mail->Username = EMAIL_USERNAME;
		$mail->Password = EMAIL_PASSWORD;

		$mail->setFrom(EMAIL_USERNAME, $params['from'] ?? '');
		$mail->addAddress($params['sendto'] ?? '', $params['sendto'] ?? '');


		$mail->Subject = $params['subject'] ?? '';
		$mail->msgHTML($params['body'] ?? ''); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
		$mail->AltBody = 'HTML messaging not supported';
		// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

		if(!$mail->send()){
			return ["Error"=>"Mailer Error: " . $mail->ErrorInfo];
		}else{
			return ["Success"=>"Email sent!"];
		}
		
		
	}
}