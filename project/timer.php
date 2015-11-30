<?php

require_once('config.php');
require_once('database.php');


$test = new data_base();
$var = "please_login";
$cookie_name = "user";
$time = $_POST['time'];

if(!isset($_COOKIE[$cookie_name])) 
{
    setcookie("user","", time() - 3600 , "/");
	
}
else 
{  
	
	$sql = "UPDATE ".DB_NAME.".timers SET prediction_timer = ".$time." , id = 0 WHERE update_timer = 1";
	$result = mysql_query($sql);
	$var = "success";
	echo json_encode(array($var,$sql));
}

?>