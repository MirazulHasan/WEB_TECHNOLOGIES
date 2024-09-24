<?php
require_once('../Models/alldb.php');
session_start();
if(empty($_SESSION['id']))
{
   header("location:../Views/login.php");
}

$res=data();
$r=$res->fetch_assoc()

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Data</title>
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
        <form action="../Controllers/editDataCheckController.php">
            <fieldset>
                <legend><h1>Edit Data</h1></legend>

                ID: <input type="text" name="id" value="<?php echo $r['ID'] ?>" readonly>
                <br><br>
                Name: <input type="text" name="name" value="<?php echo $r['Name'] ?>">
                <br><br>
                Email: <input type="text" name="email" value="<?php echo $r['Email'] ?>">
                <br><br>
                Password: <input type="text" name="pass" value="<?php echo $r['Pass'] ?>">
                <br><br>

                <button type="button" name="edit">Edit</button>
            </fieldset>
        </form>
    </div>

</body>
</html>