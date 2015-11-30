
<?php

require_once('config.php');
require_once('database.php');
require_once('mailsender.php');

$test = new data_base();
$var = "please_login";
$cookie_name = "user";


$stock_name = $_POST['stock_name'];
$stock_ticker = $_POST['stock_ticker'];
$hit_value = 0;	


if(!isset($_COOKIE[$cookie_name])) 
{
    setcookie("user","", time() - 3600 , "/");
	echo json_encode(array($var));
}
else 
{  


	$table = $_COOKIE[$cookie_name].'_watchlist';
	$sql = "SELECT * FROM ".DB_NAME.".".$table." WHERE stock_ticker = '".$stock_ticker."'";
    $result = mysql_query($sql);
   	$row = mysql_fetch_assoc($result);

	if($row['stock_ticker'] == null)
	{
		$sql = "INSERT INTO ".DB_NAME.".".$table."(stock_ticker, hit_value , stock_name) VALUES ('".$stock_ticker."','".$hit_value."','".$stock_name."')";
		$var = "success";
	}
	else
	{
		$sql = "UPDATE ".DB_NAME.".".$table." SET hit_value='".$hit_value."' WHERE stock_ticker = '".$stock_ticker."'";
		$var = "update";
	}

	$result = mysql_query($sql);
	echo json_encode(array($var));
	

}

?>