<?php  
require_once("Config/connection.php");
include("Config/authApi.php");
include("Request/CurlRequest.php");
include("BasicModule/DatabaseFunction.php");

$input = json_decode(file_get_contents("php://input"),true);
$token = generateAuthApi($input);
echo json_encode($token);

?>