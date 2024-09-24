<?php
require_once('../Models/alldb.php');

session_start();
$id = $_POST['id'];
$pass = $_POST['pass'];

if (empty($id) || empty($pass)) 
{
    $_SESSION['error'] = "Please fill up the form";
    header("location:../Views/login.php");
} 
else 
{
    if ($id === 'admin' && $pass === 'admin') 
    {
        $_SESSION['id'] = $id;
        header("location:../Views/home.php"); 
    } 
    
    else 
    {
        $status = auth($id, $pass); 
        
        if (mysqli_num_rows($status) == 1) 
        {
            $_SESSION['id'] = $id;
            header("location:../Views/customer_home.php");
        } 
        else 
        {
            $_SESSION['error'] = "Invalid User";
            header("location:../Views/login.php");
        }
    }
}

if (isset($_GET['logout'])) 
{
    unset($_SESSION['id']);
    header("location:../Views/login.php");
}
?>
