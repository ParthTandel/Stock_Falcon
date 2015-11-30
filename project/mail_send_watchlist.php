
<?php
	
	require_once('config.php');
	require_once('database.php');
	require_once('mailsender.php');

//	$test = new data_base();
	$mail_send = new mailsender();

	define('DB_USER', 'project');
	define('DB_PASS', 'tcejorp');
	define('DB_NAME', 'stockfalcon');


	$link = mysql_connect('localhost', DB_USER, DB_PASS);
				if (!$link) 
				{
					die('Could not connect: ' . mysql_error());
				}
				$db_selected = mysql_select_db(DB_NAME, $link);
				if (!$db_selected) 
				{
					die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
				}


	function select1($table,$field,$value)
			{
				$query="SELECT * FROM ".DB_NAME.".".$table." WHERE stock_ticker = '".$value."'";
				$result= mysql_query($query);
				return $result;
			}

	
				
			$current = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			$referrer = (isset($_SERVER['HTTP_REFERER']))? $_SERVER['HTTP_REFERER'] : "";

			$table="personal_info";
			
			$i=0;
		
			$query="SELECT * FROM ".DB_NAME.".".$table."";
			$result= mysql_query($query);
			

			while($row = mysql_fetch_array($result))	//getting  the list of cookies
			{
				if(!strcmp($row['type'], "USER"))
				{
					$cookie[$i]=$row['cookie'];
					$email[$i]=$row['email'];
					$i=$i+1;

				}		
			}
				
			$d=0;
			while($d<$i)
			{
				
				$t=array($cookie[$d],'watchlist');
				$table=implode('_', $t);
				$query="SELECT * FROM ".DB_NAME.".".$table."";
				$results= mysql_query($query);//getting stocks in watchlist
				$j=0;
				$flag=0;
				if($results)			
				while($row = mysql_fetch_array($results))
				{
					
					$stock[$j]=$row['stock_ticker'];		//all stocks in watchlist
					$j=$j+1;						
				}
				if($j>0)
				{
					$flag=1;			//there are stocks in the watchlist
				}
				$table="prediction";
				$field="stock_ticker";
				$k=0;
				$msg="";
				$message[$d]="Hi User! \nFollowing are the predicted values for all the stocks you have in your watchlist:  ";
				while($k<$j)
				{	
					$value=preg_replace('/\s+/', '', $stock[$k]);
					$result=select1($table,$field,$value);
					$m3=$stock[$k];
					$temp=mysql_fetch_array($result);
					$m4=$temp['predicted_value'];
					$mt=array($m3,$m4);
					$m=implode('=', $mt);
					$msg.="\n";
					$msg.=$m;		
					$k=$k+1;
				}
				$mt=array($message[$d],$msg);
				$message[$d]=implode(" ", $mt);
				
				if($flag==1)
				{
					//$mailsend->send_mail($email[$d],"Stock Falcon: Watchlist Update",$message[$d]);
					echo $email[$d]."<br>";
					echo $message[$d]."<br>";
					$mail_send->send_mail($email[$d] , "Stock Falcon: Watchlist Update", $message[$d]);
				}
				$d++;
			}

?>