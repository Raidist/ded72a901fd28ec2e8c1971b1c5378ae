<?php
	
	function generateAuthApi($input){
		$data = showWhere(['id' => 3],'tbl_user',true);
		$username = $data['username'];
		$specialId = bin2hex(random_bytes(5));
		$signature = md5("RaidistRavelion");

		$token = base64_encode($username."|".$specialId."|".$signature);
		$storeSecret = update(['special_id' => $specialId],'tbl_user','username',$username);
		if ($storeSecret == true) {
			return $token;
		}else{
			print_r(json_encode(['success' => false, 'message' => 'Create Token Fail']));
		}
		/*$result = base64_decode($token);
		$token = explode("|",$result);
		print_r(json_decode(json_encode($token),true));

		(($token[3] == md5("RaidistRavelion")) ? print_r("Auth berhasil") : print_r( "auth gagal"));*/
	}

	function checkAuth($token){
		$token = base64_decode($token);
		$token = explode("|",$token);
		if (count($token) != 3) {
			return false;
		}
		$check = showWhere(['username' => $token[0]],'tbl_user',true);
		//print_r($check).die();
		if (!empty($check)) {
			//print_r($token[1]."  ".$check['special_id']).die();
			if($token[2] != md5('RaidistRavelion')) return false;
			if($token[1] != $check['special_id']) return false;
		}else{
			return false;
		}

		return true;
	}
?>