<?php
require_once('../Models/alldb.php');
session_start();
if(empty($_SESSION['id']))
{
   header("location:../Views/home.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Insert Data</title>
	<style>
		a:hover {
            text-shadow: 0 0 5px #4CAF50, 0 0 10px #4CAF50, 0 0 15px #4CAF50;
            color: #f2f2f2;
        }

		button:hover {
            box-shadow: 0 0 10px 5px rgba(76, 175, 80, 0.5);
        }
	</style>
</head>
<body>
	<div style="width: 400px; margin: 20px auto; border: 1px solid #ccc; padding: 20px; background-color: #fff; text-align: center;">
        <form method="get" action="../Controllers/insertDataCheckController.php">
            <fieldset>
                <legend><h1>Insert Data</h1></legend>
                
                <div style="text-align: left; margin-top: 10px;">
                    ID: <input type="text" name="id" style="width: 330px;" required>
                    <br><br>
                    Name: <input type="text" name="name" style="width: 308px;" required>
                    <br><br>
                    Email: <input type="email" name="email" style="width: 308px;" required>
                    <br><br>
                    Password: <input type="password" name="pass" style="width: 285px;" required>
                    <br><br>
                </div>
                <button value="<?php $insert ?>" type="submit" name="insert" style="display: inline-block; padding: 10px 20px; background-color: #6F0047; color: #fff; text-decoration: none; border-radius: 5px;">Insert Data</button>

                <?php
				if (isset($_SESSION['error1'])) 
				{
				    echo "<p style='color: red;'>".$_SESSION['error1']."</p>";
				    unset($_SESSION['error1']);  
				}
				?>

            </fieldset>
        </form>
    </div>

</body>
</html>