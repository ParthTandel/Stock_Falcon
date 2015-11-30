<?php

require_once('config.php');
require_once('database.php');


$test = new data_base();
$var = "please_login";
$cookie_name = "user";

$stock_name = $_POST['stock_name'];
$stock_ticker = $_POST['stock_ticker'];
if(!isset($_COOKIE[$cookie_name])) 
{
    setcookie("user","", time() - 3600 , "/");
	
}
else 
{  
	$table = "prediction";
	$sql = "DELETE FROM ".DB_NAME.".prediction WHERE stock_ticker = '".$stock_ticker."'";
	$result = mysql_query($sql);
	$var = "success";
	echo json_encode(array($var,$sql,strlen($stock_ticker)));
}
?>