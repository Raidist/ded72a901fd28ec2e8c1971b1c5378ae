<?php 
require_once("Config/connection.php");
include("Config/authApi.php");
include("Request/CurlRequest.php");
include("BasicModule/DatabaseFunction.php");
require('../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$input = json_decode(file_get_contents("php://input"),true);
$checkToken = checkAuth($input['token']);
if ($checkToken == false) {
	print_r(json_encode(['success' => 'false','message' => 'Token Not Valid']));
	die();
}else{
	unset($input['token']);
}

if (!empty($input) && isset($input['email'])) {
	$mail = new PHPMailer(true);
	try{
		//Stmp Setting (change With your own setting)
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;
		$mail->isSMTP();
		$mail->Host = '';
		$mail->SMTPAuth = true;
		$mail->username = '';
		$mail->password = '';
		$mail->SMTPSecure = 'tls';
		$mail->Port       = 587;
		//$mail->SMTPAutoTLS = false;
		$mail->SMTPOptions = array(
		    'tls' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);

		//recipients setting
		$mail->setFrom('Stevan@gmail.com', 'Mailer');
		$mail->addAddress($input['email']);

		//Mail Content
		$mail->isHTML(true);
		$mail->Subject = 'Request Email';
		$mail->Body    = $input['comment'];
		
		if($mail->send()){
			$store = store($input,'email_comment');
		}else{
			print_r(json_encode(['success' => 'false','message' => 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo]));
			die();
		}

	}catch(Exception $e){
		print_r(json_encode(['success' => 'false','message' => 'Message could not be sent to user. Mailer Error: '.$mail->ErrorInfo]));
		die();
	}

	print_r(json_encode(['success' => 'true','message' => 'email sent']));
}


?>