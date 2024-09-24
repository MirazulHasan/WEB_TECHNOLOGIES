<?php
session_start();

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "myfirstdb";
$conn = new mysqli($serverName, $userName, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$nid = $dob = "";

$recover = isset($_POST['recover']);

if ($recover) 
{
    $nid = $_POST['nid'];
    $dob = $_POST['dob'];

    if (empty($nid) || empty($dob)) 
    {
        $message = "<span class='error'>Please fill in all fields.</span>";
    }
    else 
    {
        $sql = "SELECT user_id, password FROM customer_login_data WHERE nid = ? AND dob = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("ss", $nid, $dob);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) 
        {
            $user = $result->fetch_assoc();
            $user_id = htmlspecialchars($user['user_id']);
            $password = htmlspecialchars($user['password']);
            $message = "<span class='success'>User ID: $user_id<br>Password: $password</span>";
        } 
        else 
        {
            $message = "<span class='error'>No matching records found.</span>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recover User ID and Password</title>
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

        .success 
        {
            color: green;
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
            <a href="Customer_Login.php" style="color: #f2f2f2;">Login</a>

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
                <legend><h2>Recover User ID and Password</h2></legend>

                <?php if (!empty($message)) { echo $message; } ?>

                <div style="text-align: left; margin-top: 10px;">
                    NID: <input type="text" name="nid" style="width: 324px;" required>
                    
                    <br><br>

                    Date of Birth: <input type="date" name="dob" style="width: 266px;" required>

                    <br><br>

                </div>

                <button type="submit" name="recover" style="display: inline-block; padding: 10px 20px; background-color: #6F0047; color: #fff; text-decoration: none; border-radius: 5px;">Recover</button>

                <br>

                <a href="Customer_Login.php" class="glow-text">Back to Login</a>

                <br>

            </fieldset>
        </form>

    </div>

    <div style="background-color: #6F0047; overflow: hidden; white-space: nowrap; text-align: center;">

        <p style="color: #f2f2f2; text-align: center;" >Copyright © 2024 All Rights Reserved by Cabinet Division, Government of the People's Republic of Bangladesh</p>

    </div>

</body>

</html>
