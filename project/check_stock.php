<?php

require_once('config.php');
require_once('database.php');


$test = new data_base();
$var = "please_login";
$stock_ticker = $_POST['stock_ticker'];
$sql= "SELECT * FROM ".DB_NAME.".prediction WHERE stock_ticker ='".$stock_ticker."'";
$result2 = mysql_query($sql);
$row2 = mysql_fetch_assoc($result2);

if($row2['stock_name'] != null)
{
	$var = 'success';
	$url = 'http://finance.google.com/finance/info?client=ig&q=NSE%3a'.urlencode($row2['stock_ticker']);
	$varq = "";
	$output = @file_get_contents($url); 
	$vfar = substr($output,6,(strlen($output)-8));
	$obj = json_decode($vfar);


	$temp = substr($obj->{"l_cur"},3,strlen($obj->{"l_cur"}));
	$actualprice = preg_replace("/[^0-9.]/", "", $temp);

	$curr_cl = substr($obj->{"pcls_fix"},0,strlen($obj->{"pcls_fix"}));
	$curr_cl = preg_replace("/[^0-9.]/", "", $curr_cl);
	echo json_encode(array($var , $row2['stock_name'] , $actualprice , $curr_cl , $row2['predicted_value'] , $row2['confidence_value']));
}
else
{
	$var = 'false';
	echo json_encode(array($var));
}


?>
