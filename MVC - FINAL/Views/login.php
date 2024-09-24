<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Login Page</title>
</head>
<body>
   <div style="width: 400px; margin: 20px auto; border: 1px solid #ccc; padding: 20px; background-color: #fff; text-align: center;">
        <form method="post" action="../Controllers/loginCheckController.php"> 
            <fieldset>
                <legend><h1>Login Page</h1></legend>
                
                <div style="text-align: left; margin-top: 10px;">
                    ID: <input type="text" name="id" style="width: 330px;" required>
                    <br><br>
                    Password: <input type="password" name="pass" style="width: 285px;" required>
                    <br><br>
                </div>
                <button style="display: inline-block; padding: 10px 20px; background-color: #6F0047; color: #fff; text-decoration: none; border-radius: 5px;">Login</button>

               <?php
               if(isset( $_SESSION['error'])) 
               {
                  echo $_SESSION['error']; 
                  unset($_SESSION['error']);
               }?>

            </fieldset>
        </form>
    </div>

</body>
</html>