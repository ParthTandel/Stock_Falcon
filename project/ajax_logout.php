<?php

$cookie_name = "user" ;
$logout = "false";
if(!isset($_COOKIE[$cookie_name])) 
{
	echo json_encode(array($logout));
}
else 
{  
      $logout = "true";
      setcookie("user","", time() - 3600 , "/");
	  echo json_encode(array($logout));
}

?>