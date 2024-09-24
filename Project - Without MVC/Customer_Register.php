<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "myfirstdb";
$conn = new mysqli($serverName, $userName, $password, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$reg = isset($_POST['reg']);
$message = '';

if ($reg) {
    $nid = filter_input(INPUT_POST, 'nid', FILTER_SANITIZE_NUMBER_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pass = $_POST['pass']; // Save real password
    $phone = filter_input(INPUT_POST, 'phone_no', FILTER_SANITIZE_STRING);
    $dob = $_POST['dob'];
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO customer_login_data (nid, name, email, password, phone, dob, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $nid, $name, $email, $pass, $phone, $dob, $address);

    if ($stmt->execute()) {
        // Get the last inserted ID
        $last_id = $conn->insert_id;
        $message = "Registration Successful. Your user ID is: $last_id";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Government of Bangladesh - Ministry of Personnel, Public Grievances</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        a {
            display: inline-block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 17px;
        }

        a:hover {
            text-shadow: 0 0 5px #4CAF50, 0 0 10px #4CAF50, 0 0 15px #4CAF50;
            color: #f2f2f2;
        }

        img {
            height: 128px;
            margin-right: 10px;
            margin-left: 10px;
        }

        button:hover {
            box-shadow: 0 0 10px 5px rgba(76, 175, 80, 0.5);
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .glow-text {
            color: #6F0047;
        }

        .glow-text:hover {
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
        <form method="post" action="">
            <fieldset>
                <legend><h1>Customer Registration</h1></legend>
                <?php if ($message): ?>
                    <p class="<?= strpos($message, 'Error') === false ? 'success' : 'error' ?>"><?= $message ?></p>
                <?php endif; ?>
                <div style="text-align: left; margin-top: 10px;">
                    NID: <input type="text" name="nid" style="width: 320px;" required>
                    <br><br>
                    Name: <input type="text" name="name" style="width: 305px;" required>
                    <br><br>
                    Email: <input type="email" name="email" style="width: 308px;" required>
                    <br><br>
                    Password: <input type="password" name="pass" style="width: 278px;" required>
                    <br><br>
                    Phone No: <input type="text" name="phone_no" style="width: 278px;" required>
                    <br><br>
                    Date of Birth: <input type="date" name="dob" style="width: 263px;" required>
                    <br><br>
                    Address: <textarea name="address" style="width: 292px;" rows="3" required></textarea>
                    <br><br>
                </div>
                <button type="submit" name="reg" style="display: inline-block; padding: 10px 20px; background-color: #6F0047; color: #fff; text-decoration: none; border-radius: 5px;">Register</button>
                <br>
                <a href="Customer_Login.php" class="glow-text">Already have an account? Login here.</a>
                <br>
            </fieldset>
        </form>
    </div>

    <div style="background-color: #6F0047; overflow: hidden; white-space: nowrap; text-align: center;">

        <p style="color: #f2f2f2; text-align: center;" >Copyright © 2024 All Rights Reserved by Cabinet Division, Government of the People's Republic of Bangladesh</p>

    </div>
</body>

</html>
