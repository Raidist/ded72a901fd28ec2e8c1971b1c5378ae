<?php  
require_once("Config/connection.php");
include("Config/authApi.php");
include("Request/CurlRequest.php");
include("BasicModule/DatabaseFunction.php");

//print_r(file_get_contents("php://input"));

$input = json_decode(file_get_contents("php://input"));
$token = generateAuthApi($input);
//print_r($token).die();
echo json_encode(['token' => $token]);

?>