<?php

require_once('config.php');
require_once('database.php');


$test = new data_base();
$var = "please_login";
$cookie_name = "user";
echo json_encode(array($var));


/*

$stock_name = $_POST['stock_name'];
$stock_ticker = $_POST['stock_ticker'];
$hit_value = $_POST['hit_value'];	
echo json_encode(array($var));
/*
if(!isset($_COOKIE[$cookie_name])) 
{
    setcookie("user","", time() - 3600 , "/");
	
}
else 
{  


	$table = $_COOKIE[$cookie_name].'_watchlist';
	$sql = "DELETE FROM ".DB_NAME.".".$table." WHERE stock_ticker = '".$stock_ticker."'";
   // $result = mysql_query($sql);
	//$var = "success";
	//echo json_encode(array($sql));
	*/

}
?>