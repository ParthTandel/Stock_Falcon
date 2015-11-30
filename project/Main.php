

<?php
require_once('mailsender.php');
require_once('config.php');
require_once('config.php');
require_once('database.php');
if(!class_exists ('Main'))
{
   class Main
   {
       function register($login_redirect)
       {

			    if ( !empty ( $_POST ) )


				    {
				       
						$test = new data_base();
						
						$current = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
						$referrer = $_SERVER['HTTP_REFERER'];

					   	$table = 'personal_info';
					    $temp1 =  array('yash');
					    
					   
					    $first_name = $_POST['first_name'];
						$last_name = $_POST['last_name'];
						$birthdate = $_POST['birthdate'];
						$email = $_POST['email'];
						$password = $_POST['password'];
						$gender = $_POST['gender']; 
					   
					    $sql= "SELECT email FROM ".DB_NAME.".".$table." WHERE email = '".$email."'";
						$result = mysql_query($sql);
						$row = mysql_fetch_assoc($result);
						if($row != null )
						{
							echo "<br> email id already exists <br>";
							return false;
						}
					   	else
					   	{

					   		$timestamp = time();
						    $nonce = sha1('registration-' . $first_name . $last_name . $timestamp .NONCE_SALT );
						    $pass = $test->hash_password($password , $nonce); 
						 	
						 	$authmd5 = md5($birthdate.$last_name.$gender);
						    $auth = sha1($authmd5.'auth'.AUTH_SALT.$timestamp.'authorisation'.$email.$last_name);

						    $cookie = md5($last_name.$first_name.$first_name);

						    $fields = array('email','gender','timestamp','first_name','last_name','password','birthdate','auth_key' , 'cookie');			
						    $temp1 = array( $email, $gender , $timestamp ,$first_name , $last_name , $pass , $birthdate ,$auth , $cookie );

						 	$fields = $test->clean($fields); 
						 	$temp1 = $test->clean($temp1);
							
							$values1 = implode(",", $fields);
							$input1 = implode ("', '", $temp1);



						    $test->insert($values1 , $table , $input1);

						    $to = $email;
						    $subject = "Account Verification";
						    $mail = "click on the redirect link ".$referrer."?auth_key=".$auth."  to verify your account.";
						    $mail_send = new mailsender();
						    $mail_send->send_mail($to , $subject , $mail);

						}

				    }


		}
		function login($main_redirect)
		{
			   if ( !empty ( $_POST ) )
			   {
			   		$test = new data_base();
			   		$table = 'personal_info';
			   		$email = $_POST['email'];
			   		$password = $_POST['password'];
			   		$sql= "SELECT * FROM ".DB_NAME.".".$table." WHERE email = '".$email."'";
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					if($row  != null )
					{
						$first_name = $row["first_name"];
						$last_name = $row["last_name"];
						$timestamp = $row["timestamp"];
			   			$nonce = sha1('registration-' . $first_name . $last_name .$timestamp.NONCE_SALT );
						$pass = $test->hash_password($password , $nonce); 
						if($pass == $row["password"] && $row["auth_status"] == "FALSE")
						{
							$cookie_name = "user";
							$cookie_value = $row["cookie"];
							setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
							header('Location: user.php');
						}
						else
						{
							echo "<br> Incorrect password ";
						}
					}



			   }

		}
		function search()
		{
			if ( !empty ( $_POST ) )
			   {
			   		$test = new data_base();
			   		$table = $_POST['search'];
			   		$sql= "SELECT * FROM ".DB_NAME.".".$table;
					$result = mysql_query($sql);
					$row = mysql_fetch_assoc($result);
					if($row  != null )
					{
						echo $row[" "];
					}



			   }

		}

   }


}


?>