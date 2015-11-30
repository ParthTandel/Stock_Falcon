<?php


require_once('config.php');
require_once('database.php');

$test = new data_base();
$var = "please_login";
$cookie_name = "user";

$stock_ticker = $_POST['stock_ticker'];
$val= $_POST['value'];


if(!isset($_COOKIE[$cookie_name])) 
{
    setcookie("user","", time() - 3600 , "/");
	echo json_encode(array($var));
}
else 
{  

	$sql = "SELECT * FROM ".DB_NAME.".vote_".$stock_ticker." WHERE cookie = '".$_COOKIE[$cookie_name]."'";
    $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
   	

	if($row['cookie'] == null)
	{
		
		$sql = "SELECT * FROM ".DB_NAME.".prediction WHERE stock_ticker ='".$stock_ticker."'";;
		$result = mysql_query($sql);
		$row = mysql_fetch_assoc($result);
				
	
		$sql = "INSERT INTO ".DB_NAME.".vote_".$stock_ticker." (cookie) VALUES ('".$_COOKIE[$cookie_name]."')";
		$result = mysql_query($sql);
		$var = "success";
		
		
		$sql = "UPDATE ".DB_NAME.".prediction SET  ".$val."=".($row[$val]+1)." WHERE stock_ticker = '".$stock_ticker."'";
		$result = mysql_query($sql);
	
	}
	else
	{
		$var = "Already";
	}
	echo json_encode(array($var));
	
}





?>