						<?php
                      
						require_once('config.php');
						require_once('database.php');
						require_once('mailsender.php');

						$test = new data_base();
						$var = "exists";
						$var2 = "success";
						$first_name = $_POST['firstname'];
						$last_name = $_POST['lastname'];
						$birthdate = $_POST['birthdate'];
						$email = $_POST['email'];
						$password = $_POST['passwd'];
						$gender = $_POST['gender']; 
						$type = 'USER';
				
						if (filter_var($email, FILTER_VALIDATE_EMAIL))
						{
    					

							$table = 'personal_info';

							$sql = "SELECT email FROM ".DB_NAME.".".$table." WHERE email = '".$email."'";	
							$result = mysql_query($sql);
							$row = mysql_fetch_assoc($result);
							
							if($row != null )
							{

							}
							else
							{
								$var = "success";
								$timestamp = time();
							    $nonce = sha1('registration-' . $first_name . $last_name . $timestamp .NONCE_SALT );
							    $pass = $test->hash_password($password , $nonce); 
							 	
							 	$authmd5 = md5($birthdate.$last_name.$gender);
							    $auth = sha1($authmd5.'auth'.AUTH_SALT.$timestamp.'authorisation'.$email.$last_name);

							    $cookie = md5($last_name.$first_name.$email);

							    $fields = array('email','gender','timestamp','first_name','last_name','password','birthdate','auth_key' , 'cookie' , 'type');			
							    $temp1 = array( $email, $gender , $timestamp ,$first_name , $last_name , $pass , $birthdate ,$auth , $cookie ,$type );

							 	$fields = $test->clean($fields); 
							 	$temp1 = $test->clean($temp1);
								
								$values1 = implode(",", $fields);
								$input1 = implode ("', '", $temp1);
							    $test->insert($values1 , $table , $input1);
							    
							    
							    

							    $to = $email;
							    $subject = "Account Verification";
							    $mail = "click on the redirect link auth_key= http:".$_SERVER['SERVER_NAME']."/php_demo/stock_falcon/project/index.php?auth_id=".$auth."  to verify your account.";
							    $mail_send = new mailsender();
							    $mail_send->send_mail($to , $subject , $mail);
							   
							}
						}
						else
						{
									$var ="email_err";
						}
						echo json_encode(array($var));
							
						
						
			?>