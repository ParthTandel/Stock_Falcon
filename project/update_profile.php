<?php

require_once('config.php');
require_once('database.php');

$var = "please_login";
$cookie_name = "user";



$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];	
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];



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
    
      $sql = "UPDATE ".DB_NAME.".personal_info SET first_name = '".$firstname."', last_name ='".$lastname."' , birthdate ='".$birthdate."' , gender ='".$gender."' WHERE cookie = '".$_COOKIE[$cookie_name]."'";
      $result = mysql_query($sql);
      echo json_encode(array($var));

}

?>