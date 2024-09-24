<?php 
require_once('../Models/alldb.php');
session_start();
$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$sal=$_POST['sal'];

if(empty($id || $name || $email || $pass || $sal))
{
   $_SESSION['error']="Please fill up the form";
   header("location:../Views/insertData.php");
}

else
{
    $status = insert($id, $name, $email, $pass, $sal);

    if ($status) 
    {
        $_SESSION['success'] = "Data inserted successfully.";
        header("location:../Views/home.php");
    } 

    else 
    {
        $_SESSION['error1'] = "Data not inserted.";
        header("location:../Views/insertData.php");
    }
}


?>