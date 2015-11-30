<?php

require_once('config.php');
require_once('database.php');


$test = new data_base();
$sql = "SELECT * FROM stockfalcon.last WHERE id = 1";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$count = $row['counter'];
$var = $row['stock_ticker'];
$url = 'http://finance.google.com/finance/info?client=ig&q=NSE%3a'.urlencode($var);
$varq = "";
$output = @file_get_contents($url); 
$vfar = substr($output,6,(strlen($output)-8));
$obj = json_decode($vfar);
if(isset($obj->{"t"}))
{
echo "<h4>".$obj->{"t"}."</h4>";
echo "<h4>Current ".$obj->{"l_cur"}."</h4>";
echo "<h5>Previous Close Rs. ".$obj->{"pcls_fix"};
}


?>