<?php
session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Optional: Inform the user that they've been logged out
echo "You have been logged out. Redirecting to login page...";

// Redirect to login page
header('Location: Customer_Login.php');
exit(); // Ensure no further code is executed
?>