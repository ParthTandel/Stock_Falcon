
<?php

	require_once('config.php');
	require_once('database.php');
	$test = new data_base();
	
	$current = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$referrer = $_SERVER['HTTP_REFERER'];
	
	echo $table." <br>";
	

	echo $current." <br>";
	echo $referrer." <br>" ;


   	$table = 'personal_info';
    $temp1 =  array('yash');
    
   
    $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$birthdate = $_POST['birthdate'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$gender = $_POST['gender']; 
    
   

    $nonce = sha1('registration-' . $first_name . $last_name . time() .NONCE_SALT );
    $pass = $test->hash_password($password , $nonce); 
 


    $fields = array('email','gender','first_name','last_name','password','birthdate');			
    $temp1 = array($email, $gender ,$first_name , $last_name , $pass , $birthdate);

 	$fields = $test->clean($fields); 
 	$temp1 = $test->clean($temp1);

    $test->insert($fields , $table , $temp1);

   ?>
