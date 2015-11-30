<?php

require_once('config.php');
require_once('database.php');


$test = new data_base();
$var = "please_login";
$cookie_name = "user";
$stock_name = $_POST['stock_name'];
$stock_ticker = $_POST['stock_ticker'];
$quantity = $_POST['quantity'];	
$cost_price = $_POST['cost_price'];

$cost_price = substr($cost_price,3,strlen($cost_price));


if(!isset($_COOKIE[$cookie_name])) 
{
    setcookie("user","", time() - 3600 , "/");
	
}
else 
{  


	$table = $_COOKIE[$cookie_name].'_portfolio';
	$sql = "DELETE FROM ".DB_NAME.".".$table." WHERE stock_ticker = '".$stock_ticker."'AND cost_price='".$cost_price."'";
    $result = mysql_query($sql);
	$var = "success";
	echo json_encode(array($var,$sql));
	

	$sql= "SELECT * FROM ".DB_NAME.".prediction WHERE stock_ticker ='".$stock_ticker."'";
	$result2 = mysql_query($sql);
	$row2 = mysql_fetch_assoc($result2);
	$counter = $row2['counter'];
	$counter --;
	if($var == "success")
	{
		$sql = "UPDATE ".DB_NAME.".prediction SET counter =".$counter." WHERE stock_ticker = '".$stock_ticker."'";
		$result = mysql_query($sql);
	}

}

?>