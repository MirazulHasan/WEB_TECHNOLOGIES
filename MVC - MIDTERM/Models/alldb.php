<?php
require_once('db.php');
function auth($id,$pass)
{
	$con=con();
	$sql="select * from ab where ID='$id' and Pass='$pass'";
	$res=mysqli_query($con,$sql);
	return $res;
}

function data()
{
	$con=con();
	$sql="select * from ab";
	$res=mysqli_query($con,$sql);
	return $res;
}

function delete($id)
{
	$con=con();
	$sql="Delete from ab where ID='$id'";
	$res=mysqli_query($con,$sql);
	return $res ;
}

function insert($id, $name, $email, $pass)
{
    $con = con();
    $stmt = $con->prepare("INSERT INTO ab (id, name, email, pass) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id, $name, $email, $pass);

    if ($stmt->execute()) 
    {
        return true;
    } 
    
    else 
    {
        return false;
    }

    $stmt->close();
    $con->close();
}

function edit($id)
{
	$con=con();
	$sql="SELECT * from ab where ID='$id'";
	$res=mysqli_query($con,$sql);
	return $res ;
}

function update($id, $name, $email, $pass)
{
	$con=con();
	$sql="UPDATE ab Set name = '$name', email = '$email', pass = '$pass' where ID='$id'";
	$res=mysqli_query($con,$sql);
	return $res ;
}
?>