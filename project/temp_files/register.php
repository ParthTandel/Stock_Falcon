<?php
	require_once('Main.php');
	$j = new Main();
	$j->register('login.php');
?>


<html>
	<head>
		<title>Registration Form</title>
		<style type="text/css">
			body { background: #c7c7c7;}
		</style>
		<script src="form_validate.js"></script>
		<script>
		{
			 document.getElementById("myForm").reset(); 
		}
		</script>
	</head>

	<body>
		<div style="width: 400px; background: #fff; border: 1px solid #e4e4e4; padding: 20px; margin: 50px auto;">
			<h3>Register</h3>
			
			
			<form name="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm()" method="post">
				<table>
					<tr>
						<td>First Name:</td>
						<td><input type="text" name="first_name" /></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><input type="text" name="last_name" /></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password" /></td>
					</tr>
					<tr>
						<td>Retype Password: </td>
						<td><input type="password" name="temp_password" /></td>
					</tr>
					<tr>
						<td>Birth date:</td>
						<td><input type="date" name="birthdate" /></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="email" name="email" /></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td>	<input type="radio" name="gender" value="female">Female
								<input type="radio" name="gender" value="male">Male </td>
					 </tr>



                     <tr>
						<td></td>
						<td><input type="submit" value="Register" /></td>
					</tr>

				</table>
			</form>
			<p>Already a member? <a href="login.php">Log in here</a></p>
		</div>
	</body>
</html>





