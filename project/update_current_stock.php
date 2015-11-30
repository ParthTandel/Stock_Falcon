<?php


require_once('config.php');
require_once('database.php');
require_once('mailsender.php');

$test = new data_base();

$stock_ticker = $_POST['stock_ticker'];
$url = 'http://finance.google.com/finance/info?client=ig&q=NSE%3a'.urlencode($stock_ticker);
$varq = "";
$output = @file_get_contents($url); 
$vfar = substr($output,6,(strlen($output)-8));
$obj = json_decode($vfar);
$values_now = $obj->{"l_cur"} ;

$temp = substr($values_now,3,strlen($values_now));
$actualprice = preg_replace("/[^0-9.]/", "", $temp);

$curr_cl = substr($obj->{"pcls_fix"},0,strlen($obj->{"pcls_fix"}));
$curr_cl = preg_replace("/[^0-9.]/", "", $curr_cl);

$sql = "SELECT * FROM ".DB_NAME.".prediction WHERE stock_ticker ='".$stock_ticker."'";;
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
$sell = $row['sell_poll'];
$buy = $row['buy_poll'];
$hold = $row['hold_poll'];

$total = $sell+$buy+$hold;

if($total >0)
{
	$sell_per = ($sell*100)/$total;
	$buy_per = ($buy*100)/$total;
	$hold_per = ($hold*100)/$total;

 	$var = max($sell_per , $buy_per , $hold_per);
	$html = $sell_per."% of StockFalcon users who have polled, voted for selling this stock"."<br>".$buy_per."% of StockFalcon users who have polled, voted for buying this stock"."<br>".$hold_per."% of StockFalcon users who have polled, voted to hold this stock";

}
else
{
	$html = "No one voted the stock yet";
}
echo json_encode(array($actualprice , $curr_cl ,$html));

?>