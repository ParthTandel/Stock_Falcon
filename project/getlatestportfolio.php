<?php

require_once('config.php');
require_once('database.php');

$test = new data_base();
$var = $_POST['stock_ticker'];

$costprice = $_POST['cost_price'];
$quantity = $_POST['quantity'];

$url = 'http://finance.google.com/finance/info?client=ig&q=NSE%3a'.urlencode($var);
$varq = "";
$output = @file_get_contents($url); 
$vfar = substr($output,6,(strlen($output)-8));
$obj = json_decode($vfar);
$values_now = $obj->{"l_cur"} ;

$temp = substr($values_now,3,strlen($values_now));
$actualprice = preg_replace("/[^0-9.]/", "", $temp);

$costprice = substr($costprice,3,strlen($costprice));
$costprice = preg_replace("/[^0-9.]/", "", $costprice);

$var1 =  $quantity * $actualprice; 
$var2 = $quantity * $costprice; 

$profit_loss = (float)$var1 - (float)$var2; 
echo json_encode(array($values_now , $profit_loss));

?>