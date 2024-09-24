<?php
session_start();
require_once('../Models/alldb.php');
$id=$_GET['edit'];
$status=update($id);
if($status)
{
    $_SESSION['mes']="Edited";
    header("location:../Views/home.php");
}

?>