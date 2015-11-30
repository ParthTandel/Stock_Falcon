

<?php
    require_once('Main.php');
    $j = new Main();
    $j->login('temp.php');
?>




<html>
    <head>
        <title>Registration Form</title>
        <style type="text/css">
            body { background: #c7c7c7;}
        </style>
        <link rel="stylesheet" type="text/css" href="main.css">
       
        <script>
        {
             document.getElementById("myForm").reset(); 
        }
        </script>
    </head>

    <body>
        <div style="width: 400px; background: #fff; border: 1px solid #e4e4e4; padding: 20px; margin: 50px auto;">
            <h3>Login</h3>
            
            
            <form name="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" /></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" /></td>
                    </tr>
                    <tr>
                        <td>Not a member Register </td>
                        <td><a href="register.php"> Register</a></td>
                    </tr>
                     <tr>
                        <td></td>
                        <td><input type="submit" value="Sign in" /></td>
                    </tr>
                </table>
            </form> 

        </div>
    </body>
       
 </html> 
