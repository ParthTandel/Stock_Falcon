<?php

require_once('config.php');
require_once('database.php');

$var = "please_login";
$cookie_name = "user";



$cpass = $_POST['cpass'];
$npass = $_POST['npass'];	


if(!isset($_COOKIE[$cookie_name])) 
{
            setcookie("user","", time() - 3600 , "/");
		echo json_encode(array($var));
}
else 
{  

      $var = "success";
      $table = 'personal_info';		
      $test = new data_base();
      $sql= "SELECT * FROM ".DB_NAME.".".$table." WHERE cookie = '".$_COOKIE[$cookie_name]."'";
      $result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
      $password = $row['password'];
	$nonce = sha1('registration-' . $row['first_name'] . $row['last_name'] . $row['timestamp'] .NONCE_SALT );
	$pass = $test->hash_password($cpass , $nonce); 
    
      if($pass == $password )
      {
            $timestamp = time();
            $nonce = sha1('registration-'.$row['first_name'].$row['last_name'].$timestamp.NONCE_SALT );
            $newpass = $test->hash_password($npass , $nonce); 
          
            $sql = "UPDATE ".DB_NAME.".personal_info SET password = '".$newpass."', timestamp ='".$timestamp."' WHERE cookie = '".$_COOKIE[$cookie_name]."'";
            $result = mysql_query($sql);
      

            $var = "success";
	      echo json_encode(array($var));
      } 
      else
      {
            $var = "pass_err";
            echo json_encode(array($var));
      }
}



?>
