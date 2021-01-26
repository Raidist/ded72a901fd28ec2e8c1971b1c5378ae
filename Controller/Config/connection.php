<?php 
$host = "localhost";
$port = "5432";
$dbname = "PHPResfulApi";
$user = "postgres";
$password = "admin"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$GLOBALS['dbconn'] = pg_connect($connection_string);
//print_r(json_decode(json_encode($dbconn)));
//var_dump($dbconn);
?>