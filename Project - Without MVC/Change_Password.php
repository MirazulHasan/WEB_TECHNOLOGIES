<?php
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) 
{
    header('Location: Customer_Login.php'); // Redirect to login page if not logged in
    exit();
}

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "myfirstdb";
$conn = new mysqli($serverName, $userName, $password, $dbName);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id']; // Get user ID from session

// Update password
$update_success = "";
$update_error = "";

if (isset($_POST['change_password'])) 
{
    $current_password = trim($_POST['current_password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current password from the database
    $sql = "SELECT password FROM customer_login_data WHERE nid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();

    // Check if passwords match (plaintext comparison)
    if ($current_password === $user_data['password']) 
    {
        if ($new_password === $confirm_password) 
        {
            if ($current_password === $new_password) 
            {
                $update_error = "Your new password cannot be the same as your old password.";
            } 

            else 
            {
                // Save the new password as plain text
                $update_sql = "UPDATE customer_login_data SET password = ? WHERE nid = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("si", $new_password, $user_id);

                if ($update_stmt->execute()) 
                {
                    $update_success = "Password updated successfully.";
                } 

                else 
                {
                    $update_error = "Error updating password: " . $conn->error;
                }
            }
        } 

        else 
        {
            $update_error = "New passwords do not match.";
        }
    } 

    else 
    {
        $update_error = "Current password is incorrect.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Change Password</title>

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
            background-color: #4CAF50;
            color: black;
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

        .success-message 
        {
            color: green;
            font-weight: bold;
        }

        .error-message 
        {
            color: red;
            font-weight: bold;
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

            <a href="Customer_View_Profile.php" style="color: #f2f2f2;">View Profile</a>
            <a href="#" style="color: #f2f2f2;">Register Complaint</a>
            <a href="#" style="color: #f2f2f2;">Check Status</a>
            <a href="#" style="color: #f2f2f2;">Reopen Complaint</a>
            <a href="Change_Password.php" style="color: #f2f2f2;">Change Password</a>
            <a href="Logout.php" style="color: #f2f2f2;">Logout</a>

        </span>

        <span style="float: left;">

            <a href="#" style="color: #f2f2f2;">Home</a>
            <a href="#" style="color: #f2f2f2;">Contact Us</a>
            <a href="#" style="color: #f2f2f2;">About Us</a>
            <a href="#" style="color: #f2f2f2;">FAQs</a>

        </span>

    </div>

    <div style="width: 400px; margin: 20px auto; border: 1px solid #ccc; padding: 20px; background-color: #fff; text-align: center;">

        <form method="post" action="">

            <fieldset>

                <legend><h1>Change Password</h1></legend>

                <?php if ($update_success): ?>

                    <div class="success-message"><?php echo htmlspecialchars($update_success); ?></div>

                <?php endif; ?>

                <?php if ($update_error): ?>

                    <div class="error-message"><?php echo htmlspecialchars($update_error); ?></div>

                <?php endif; ?>

                <div style="text-align: left; margin-top: 20px;">

                    <label for="current_password">Current Password:</label>

                    <input type="password" id="current_password" name="current_password" style="width: 224px;" required>
                
                    <br><br>
                    
                    <label for="new_password">New Password:</label>

                    <input type="password" id="new_password" name="new_password" style="width: 245px;" required>
                    
                    <br><br>
                    
                    <label for="confirm_password">Confirm New Password:</label>

                    <input type="password" id="confirm_password" name="confirm_password" style="width: 185px;" required>

                </div>
                
                <br>

                <button type="submit" name="change_password" style="display: inline-block; padding: 10px 20px; background-color: #6F0047; color: #fff; text-decoration: none; border-radius: 5px;">Change Password</button>

            </fieldset>

        </form>

    </div>

    <div style="background-color: #6F0047; overflow: hidden; white-space: nowrap; text-align: center;">

        <p style="color: #f2f2f2; text-align: center;" >Copyright © 2024 All Rights Reserved by Cabinet Division, Government of the People's Republic of Bangladesh</p>

    </div>

</body>

</html>
