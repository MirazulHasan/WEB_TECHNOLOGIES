<?php
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: Customer_Login.php'); // Redirect to login page if not logged in
    exit();
}

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "myfirstdb";
$conn = new mysqli($serverName, $userName, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id']; // Get user ID from session

// Fetch user data
$sql = "SELECT nid, name, email, phone, dob, address FROM customer_login_data WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Initialize user_data
$user_data = null;
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    // Handle no data found scenario
    echo "No user data found.";
}

// Initialize messages
$update_success = "";
$update_error = "";

// Update user data
if (isset($_POST['save'])) {
    // Retrieve form data
    $nid = $_POST['nid'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $address = $_POST['address'] ?? '';

    // Prepare and execute update statement
    $update_sql = "UPDATE customer_login_data SET nid = ?, name = ?, email = ?, phone = ?, dob = ?, address = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("isssssi", $nid, $name, $email, $phone, $dob, $address, $user_id);

    if ($update_stmt->execute()) {
        $update_success = "Profile updated successfully.";
        
        // Fetch updated data
        $stmt->execute();
        $user_data = $stmt->get_result()->fetch_assoc();
    } else {
        $update_error = "Error updating profile: " . $conn->error;
    }
}

// Close connection
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
            background-color: #4CAF50;
            color: black;
        }

        img {
            height: 128px;
            margin-right: 10px;
            margin-left: 10px;
        }

        button:hover {
            box-shadow: 0 0 10px 5px rgba(76, 175, 80, 0.5);
        }

        .success-message {
            color: green;
            font-weight: bold;
            text-align: center;
        }

        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
    <script>
        let originalValues = {};

        function enableEditing() {
            originalValues = {
                nid: document.getElementById('nid').value,
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                dob: document.getElementById('dob').value,
                address: document.getElementById('address').value
            };

            document.getElementById('nid').readOnly = false;
            document.getElementById('name').readOnly = false;
            document.getElementById('email').readOnly = false;
            document.getElementById('phone').readOnly = false;
            document.getElementById('dob').readOnly = false;
            document.getElementById('address').readOnly = false;

            document.getElementById('edit-btn').style.display = 'none';
            document.getElementById('save-btn').style.display = 'inline-block';
            document.getElementById('cancel-btn').style.display = 'inline-block';
        }

        function disableEditing() {
            document.getElementById('nid').value = originalValues.nid;
            document.getElementById('name').value = originalValues.name;
            document.getElementById('email').value = originalValues.email;
            document.getElementById('phone').value = originalValues.phone;
            document.getElementById('dob').value = originalValues.dob;
            document.getElementById('address').value = originalValues.address;

            document.getElementById('nid').readOnly = true;
            document.getElementById('name').readOnly = true;
            document.getElementById('email').readOnly = true;
            document.getElementById('phone').readOnly = true;
            document.getElementById('dob').readOnly = true;
            document.getElementById('address').readOnly = true;

            document.getElementById('edit-btn').style.display = 'inline-block';
            document.getElementById('save-btn').style.display = 'none';
            document.getElementById('cancel-btn').style.display = 'none';
        }
    </script>
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
        <form method="post" enctype="multipart/form-data">
            <fieldset>
                <legend><h1>Customer Profile</h1></legend>
                <?php if ($update_success): ?>
                    <p class="success-message"><?php echo $update_success; ?></p>
                <?php endif; ?>
                <?php if ($update_error): ?>
                    <p class="error-message"><?php echo $update_error; ?></p>
                <?php endif; ?>
                <div style="text-align: left; margin-top: 20px;">
                    <p style="color: green; font-weight: bold; text-align: center;">User ID: <?php echo htmlspecialchars($user_id); ?> </p>   
                    NID: <input type="text" id="nid" name="nid" value="<?php echo htmlspecialchars($user_data['nid']); ?>" readonly style="width: 323px;">
                    <br><br>
                    Name: <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>" readonly style="width: 307px;">
                    <br><br>
                    Email: <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" readonly style="width: 310px;">
                    <br><br>
                    Phone No: <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user_data['phone']); ?>" readonly style="width: 280px;">
                    <br><br>
                    Date of Birth: <input type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($user_data['dob']); ?>" readonly style="width: 265px;">
                    <br><br>
                    Address: <textarea id="address" name="address" readonly style="width: 294px; height: 40px;"><?php echo htmlspecialchars($user_data['address']); ?></textarea>
                    <br><br>
                    <div style="text-align: center;">
                        <button type="button" id="edit-btn" onclick="enableEditing()" style="display: inline-block; padding: 10px 20px; background-color: #6F0047; color: #fff; border-radius: 5px;">Edit</button>

                        <button type="submit" id="save-btn" name="save" style="display: none; padding: 10px 20px; background-color: #6F0047; color: #fff; border-radius: 5px;">Save</button>

                        <button type="button" id="cancel-btn" onclick="disableEditing()" style="display: none; padding: 10px 20px; background-color: #6F0047; color: #fff; border-radius: 5px;">Cancel</button>

                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <div style="background-color: #6F0047; overflow: hidden; white-space: nowrap; text-align: center;">
        <p style="color: #f2f2f2; text-align: center;">Copyright © 2024 All Rights Reserved by Cabinet Division, Government of the People's Republic of Bangladesh</p>
    </div>
</body>
</html>
