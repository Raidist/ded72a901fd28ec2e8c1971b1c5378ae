<?php
	require_once("Controller/Config/connection.php");
	include("Controller/Request/CurlRequest.php");
	session_start();
	$token = "";
	$success = "";

	if (isset($_POST['generate'])) {
		$token = post('http://localhost/ded72a901fd28ec2e8c1971b1c5378ae/Controller/GenerateTokenApi.php',['id' => 1,'username' => 'broyld']);
		$token = json_decode($token,true);
		//print_r($token).die();
		if ($token['success'] == false) {
			echo $token['message'];
		}else{
			unset($_POST);
			$_SESSION['token'] = $token['token'];
		}
	}

	if (isset($_POST['send'])) {
		//print_r($_SESSION['token']).die();
		if (!empty($_SESSION['token'])) {
			$input = [
				"email" => $_POST['email'],
				"token" => $_SESSION['token'],
				"comment" => $_POST['comment'],
			];
			$send = post('http://localhost/ded72a901fd28ec2e8c1971b1c5378ae/Controller/ApiSendEmail.php',$input);
			$send = json_decode($send,true);
			if ($send['success'] == true) {
				$success = $send['message'];
			}else{
				$success = $send['message'];
			}
			//print_r($send).die();
		}else{
			$success =  "Token is Empty Please Generate New one";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test API</title>
</head>
<body>

 <form action="index.php" method="post" name="form1">
 	<input type="submit" name="generate" value="Generate"></input>
 	</br>
 	<label>Please Use this Token : </label>
	<label name ="token" value=""><?php echo $_SESSION['token'] ?></label>
	<hr>

	<label>Send Email</label>
	<br>
	<label>Enter Email Destination</label>
	<input type="text" name="email">
	<br>
	<label>Email Message</label>
	<textarea name="comment"></textarea>
	<br>
	<input type="submit" name="send">
	<label><?= $success ?></label>
 </form>

</body>
</html>