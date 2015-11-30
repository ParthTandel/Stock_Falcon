<?php


	
	require_once('config.php');
	require_once('database.php');
	$var = $_POST['Email'];
	$passw = $_POST['password'];
	$result1 = array("email" =>$var," password"=> $passw); 
	$test = new data_base();
	$table = 'personal_info';
	$pass_e ="current";
	$email_e ="current";
	$type = "";
	
	$sql= "SELECT * FROM ".DB_NAME.".".$table." WHERE email = '".$var."'";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					if($row  != null )
					{
						$first_name = $row["first_name"];
						$last_name = $row["last_name"];
						$timestamp = $row["timestamp"];
						$type = $row["type"];
			   			$nonce = sha1('registration-' . $first_name . $last_name .$timestamp.NONCE_SALT );
						$pass = $test->hash_password($passw , $nonce);

						if($pass == $row["password"] && $row["auth_status"] == "TRUE")
						{
							$cookie_name = "user";
							$cookie_value = $row["cookie"];
							setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
							
						}
						else
						{
							$pass_e = "password";
						}
					}
					else
					{
						$email_e ="email";
					}
	echo json_encode(array($email_e,$pass_e , $type));
				
?>