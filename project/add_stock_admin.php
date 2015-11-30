
<?php

require_once('config.php');
require_once('database.php');

$var = "please_login";
$cookie_name = "user";

$stock_ticker = $_POST['stock_ticker'];
$test = new data_base();
//$stock_ticker = "ZEEL";
if(!isset($_COOKIE[$cookie_name])) 
{
        setcookie("user","", time() - 3600 , "/");
		echo json_encode(array($var));
}
else 
{  

	     
	      $table = 'personal_info';		
	      $test = new data_base();
	      $sql= "SELECT * FROM ".DB_NAME.".".$table." WHERE cookie = '".$_COOKIE[$cookie_name]."'";
	      $result = mysql_query($sql);
		  $row = mysql_fetch_assoc($result);
		  if($row["type"] == "ADMIN")
		  {

				$url = 'http://finance.google.com/finance/info?client=ig&q=NSE%3a'.$stock_ticker;
				$url = 'http://d.yimg.com/autoc.finance.yahoo.com/autoc?query='.$stock_ticker.'.ns&callback=YAHOO.Finance.SymbolSuggest.ssCallback';
				$varq = "";
				$output = @file_get_contents($url); 
				$vfar = substr($output,84,strlen($output)-84);
				$obj = json_decode($vfar);
				$pieces = explode("\"", $vfar);

				if(isset($pieces[6]))
				{	 
					$var = "success";
					$sql= "SELECT * FROM ".DB_NAME.".prediction WHERE stock_ticker ='".$stock_ticker."'";
	  				$result2 = mysql_query($sql);
	  				$row2 = mysql_fetch_assoc($result2);
	  				if($row2['stock_ticker'] == null)
					{
						$sql= "INSERT INTO ".DB_NAME.".prediction (stock_ticker, stock_name) VALUES ('".strtoupper($stock_ticker)."','".$pieces[6]."')";
	  					$result2 = mysql_query($sql);
	  					$sql = "CREATE TABLE IF NOT EXISTS vote_".strtoupper($stock_ticker)." (  cookie varchar(200) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	  					$result2 = mysql_query($sql);
						echo json_encode(array($var , $pieces[2] , $pieces[6]));

					}
	  				else
	  				{
	  					$var = "already";
	  					echo json_encode(array($var));
	  				}
					
				}
				else
				{
					 $var = "error"; 
					 echo json_encode(array($var));
				}
			}
			else
			{
				 $var = "not_admin"; 
				 echo json_encode(array($var));
			}
}
?>