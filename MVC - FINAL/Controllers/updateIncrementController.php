<?php
require_once('../Models/alldb.php'); 

session_start();

if (isset($_POST['id']) && isset($_POST['increment'])) 
{
    $id = $_POST['id'];
    $increment = $_POST['increment'];

    $updateResult = updateSalary($id, $increment);

    if ($updateResult) 
    {
        $_SESSION['success'] = "Increment updated successfully!";
    } 

    else 
    {
        $_SESSION['error'] = "Failed to update the increment or invalid user ID!";
    }

    header("location:../Views/home.php");
} 

else 

{
    $_SESSION['error'] = "Invalid input!";
    header("location:../Views/home.php");
}
