<?php 

function con()
{
	$serverName="localhost";
	$userName="root";
	$password="";
	$dbname="abd";
	$conn=new mysqli($serverName,$userName,$password,$dbname);
	return $conn;
}

?>