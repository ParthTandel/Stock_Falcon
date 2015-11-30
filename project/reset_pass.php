<?php



function generateRandomString($length = 10) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



require_once('config.php');
require_once('database.php');
require_once('mailsender.php');

$test = new data_base();

$email = $_POST['email'];

$var = "email_err";
$table = 'personal_info';
$sql = "SELECT * FROM ".DB_NAME.".".$table." WHERE email = '".$email."'";	
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);

if($row == null )
{
   echo json_encode(array($var));
}
else
{
    $var = "success";
    $npass = mt_rand(10000, 99999);
    
    $timestamp = time();

    $nonce = sha1('registration-'.$row['first_name'].$row['last_name'].$timestamp.NONCE_SALT );
    $newpass = $test->hash_password($npass , $nonce); 

    $sql = "UPDATE ".DB_NAME.".personal_info SET password = '".$newpass."', timestamp ='".$timestamp."' WHERE email = '".$email."'";
    $result = mysql_query($sql);
   
    					  

     $to = $email;
     $subject = "Forgot Password";
	 $mail = "New password is = ".$npass;
     $mail_send = new mailsender();
	 $mail_send->send_mail($to , $subject , $mail);
	 echo json_encode(array($var,$sql,$npass));

}


?>