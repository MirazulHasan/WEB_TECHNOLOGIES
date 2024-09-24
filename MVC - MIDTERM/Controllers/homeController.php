<?php
session_start();
require_once('../Models/alldb.php');
$id=$_GET['delete'];
$status=delete($id);
if($status)
{
    $_SESSION['mes']="Deleted";
    header("location:../Views/home.php");
}

if(isset($_GET['edit']))
{
    $id=$_GET['id'];
    $status=edit($id);

    if($status)
    {
        header("location:../Views/editData.php?id='$id'");
    }
}

if(isset($_GET['update']))
{
    $id=$_GET['id'];
    $name=$_GET['name'];
    $email=$_GET['email'];
    $pass=$_GET['pass'];
    $status=update($id, $name, $email, $pass);

    if($status)
    {
        header("location:../Views/home.php");
    }

    else
    {
        header("location:../Views/editData.php");
    }
}
?>