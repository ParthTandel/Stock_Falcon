
<?php

	
require_once('config.php');
require_once('database.php');
require_once('mailsender.php');

$mail_send = new mailsender();
$test = new data_base();

$var = "please_login";
$cookie_name = "user";
$table = 'personal_info';



$subject = $_POST['subject'];
$message = $_POST['message'];	



if(!isset($_COOKIE[$cookie_name])) 
{
    setcookie("user","", time() - 3600 , "/");
	echo json_encode(array($var));
}
else 
{  
	$var = "success";
	$sql= "SELECT * FROM ".DB_NAME.".".$table." WHERE cookie = '".$_COOKIE[$cookie_name]."'";
    $result = mysql_query($sql);
	$row = mysql_fetch_assoc($result);
	
	 
	 $string = "from : ".$row['email']."\n";
	 $message1 = $string.$message;
	 $mail_send->send_mail("201201116@daiict.ac.in" , $subject , $message1 );
	 echo json_encode(array($var));
	

}


?>