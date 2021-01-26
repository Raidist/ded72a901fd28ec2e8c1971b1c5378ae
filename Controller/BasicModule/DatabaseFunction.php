<?php
	function store($input = [],$table){
		$field = array();
		foreach ($input as $key => $value) {
			$field[] = $key;
		}
		$field = implode(",",$field);
		try{
			$sql = "Insert Into ".$table."(".$field.") SELECT ";
			foreach ($input as $key => $value) {
				$sql .= "'".$value."' as ".$key.",";
			}
			
			$sql = substr($sql,0,-1);
			//$sql .=")";
			//print_r($sql).die();
			$result = pg_query($GLOBALS['dbconn'],$sql);

		}catch(Exception $e){
			print_r($e).die();
		}

		return $result;
	}

	function update($input = [],$table,$field,$where){
		try{
			$sql = "Update {$table} SET ";
			foreach ($input as $key => $value) {
				$sql .= $key." = '".$value."' ,";
			}
			$sql = substr($sql,0,-1);
			$sql .= "WHERE {$field} = '".$where."'";
			//print_r($sql).die();
			$result = pg_query($GLOBALS['dbconn'],$sql);
		}catch(Exception $e){
			print_r($e).die();
		}

		return $result;
	}

	function showWhere($where=[],$table,$limit = false){
		try{
			$sql = "SELECT * FROM {$table} ";
			if (!empty($where) && is_array($where)) {
				$count = 0;
				foreach ($where as $key => $value) {
					if ($count == 0) {
						$sql .= "Where ".$key." = '".$value."' ";
						$count++;
					}else{
						$sql .= "AND ".$key." = '".$value."'";
						$count++;
					}
				}
			}
			//print_r($sql).die();
			$query = pg_query($GLOBALS['dbconn'],$sql);
			$result = pg_fetch_assoc($query);
			if (empty($result)) {
				print_r(json_encode(['success' => false, 'message' => 'data kosong']));
			}

		}catch(Exeption $e){
			print_r($e).die();
		}
		if (!empty($limit) && $limit == true) {
			return $result;	
		}else{
			return $result;
		}
		
	}
?>