<?php
session_start();

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "myfirstdb";
$conn = new mysqli($serverName, $userName, $password, $dbName);

$error = "";
$user_id = $pass = "";
$login = isset($_POST['login']);

if ($login) 
{
    $user_id = $_POST['user_id'];
    $pass = $_POST['pass'];

    if (empty($user_id) || !is_numeric($user_id) || empty($pass)) 
    {
        $error = "Please fill in all fields correctly.";
    }
    
    else 
    {
        $sql = "SELECT user_id FROM customer_login_data WHERE user_id = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $user_id, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) 
        {
            $user = $result->fetch_assoc(); // Fetch user ID
            $_SESSION['user_id'] = $user['user_id']; // Store user ID in session
            header('Location: Customer_View_Profile.php'); // Redirect to profile page
            exit();
        } 
        
        else 
        {
            $error = "Login failed. Please check your credentials.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Government of Bangladesh - Ministry of Personnel, Public Grievances</title>
    
    <style>

        body 
        {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        a 
        {
            display: inline-block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 17px;
        }

        a:hover 
        {
            text-shadow: 0 0 5px #4CAF50, 0 0 10px #4CAF50, 0 0 15px #4CAF50;
            color: #f2f2f2;
        }

        img 
        {
            height: 128px;
            margin-right: 10px;
            margin-left: 10px;
        }

        button:hover 
        {
            box-shadow: 0 0 10px 5px rgba(76, 175, 80, 0.5);
        }

        .error 
        {
            color: red;
            font-weight: bold; /* Make the text bold */
        }

        .glow-text 
        {
            color: #6F0047;
        }

        .glow-text:hover 
        {
            text-shadow: 0 0 5px #4CAF50, 0 0 10px #4CAF50, 0 0 15px #4CAF50;
            color: #6F0047;
        }

    </style>

</head>

<body>

    <div style="background-color: #6F0047; overflow: hidden; white-space: nowrap;"></div>

    <div style="background-color: #6F0047; overflow: hidden; white-space: nowrap; text-align: center;">

        <h2 style="color: #f2f2f2">Government of Bangladesh - Ministry of Personnel, Public Grievances</h2>

    </div>

    <div style="text-align: center;">

        <img src="Source/GRS.png" alt="Logo">
        <img style="float: left;" src="Source/BD_Logo.png" alt="BD_Logo">
        <img style="float: right" src="Source/Mujib.png" alt="Mujib">

    </div>

    <div style="background-color: #6F0047; overflow: hidden; white-space: nowrap; text-align: center;">
        
        <span style="float: right;">

            <a href="Customer_Login.php" style="color: #f2f2f2;">View Profile</a>
            <a href="Customer_Login.php" style="color: #f2f2f2;">Register Complaint</a>
            <a href="Customer_Login.php" style="color: #f2f2f2;">Check Status</a>
            <a href="Customer_Login.php" style="color: #f2f2f2;">Reopen Complaint</a>
            <a href="Customer_Register.php" style="color: #f2f2f2;">Register</a>

        </span>

        <span style="float: left;">

            <a href="#" style="color: #f2f2f2;">Home</a>
            <a href="#" style="color: #f2f2f2;">Contact Us</a>
            <a href="#" style="color: #f2f2f2;">About Us</a>
            <a href="#" style="color: #f2f2f2;">FAQs</a>

        </span>

    </div>

    <div style="width: 400px; margin: 20px auto; border: 1px solid #ccc; padding: 20px; background-color: #fff; text-align: center;">

        <form method="post">

            <fieldset>

                <legend><h1>Customer Login</h1></legend>

                <?php if (!empty($error)) { echo "<span class='error'>$error</span>"; } ?>

                <div style="text-align: left; margin-top: 10px;">

                    User ID: <input type="text" name="user_id" style="width: 294px;" required>
                    
                    <br><br>

                    Password: <input type="password" name="pass" style="width: 278px;" required>

                    <br><br>

                </div>

                <button type="submit" name="login" style="display: inline-block; padding: 10px 20px; background-color: #6F0047; color: #fff; text-decoration: none; border-radius: 5px;">Login</button>

                <br>

                <a href="Customer_Forget_Password.php" class="glow-text">Forget User ID or Password?</a>

                <a href="Customer_Register.php" class="glow-text">Don't have an account? Create new.</a>

                <br>

            </fieldset>

        </form>

    </div>

    <div style="background-color: #6F0047; overflow: hidden; white-space: nowrap; text-align: center;">

        <p style="color: #f2f2f2; text-align: center;" >Copyright © 2024 All Rights Reserved by Cabinet Division, Government of the People's Republic of Bangladesh</p>

    </div>

</body>

</html>
