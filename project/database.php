<?php
	require_once('config.php');
	if(!class_exists('data_base'))
	{
		class data_base 
		{

			function data_base() 
			{
				return $this->connect();
			}

			function connect() 
			{
				
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
			}

			function insert($values , $table , $input )
			{
				
				$sql= "INSERT INTO ".DB_NAME.".".$table." (".$values.") VALUES ('". $input. "')";
			    $result = mysql_query($sql);
			}
			function hash_password($password, $nonce) 
			{
		  		$secureHash = hash_hmac('sha512', $password . $nonce, SITE_KEY);
		 		return $secureHash;
		 	}


		 	function clean($array) 
		 	{
				return array_map('mysql_real_escape_string', $array);
		   	}

		

		    function temp()
		    {
		    	echo 'parthgghgh';
		    }
		}

	}
?>
