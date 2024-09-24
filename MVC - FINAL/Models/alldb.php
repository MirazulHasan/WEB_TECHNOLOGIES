<?php
require_once('db.php');

function auth($id,$pass)
{
	$con=con();
	$sql="select * from ab where ID='$id' and Pass='$pass'";
	$res=mysqli_query($con,$sql);
	return $res;
}

function data($id) 
{
    $con = con();  
    $sql = "SELECT * FROM ab WHERE ID = '$id'";
    $res = mysqli_query($con, $sql);
    return $res;
}

function data2() 
{
    $con = con();  
    $sql = "SELECT * FROM ab";
    $res = mysqli_query($con, $sql);
    return $res;
}


function delete($id)
{
	$con=con();
	$sql="Delete from ab where ID='$id'";
	$res=mysqli_query($con,$sql);
	return $res ;
}

function insert($id, $name, $email, $pass, $sal)
{
    $con = con();
    $stmt = $con->prepare("INSERT INTO ab (id, name, email, pass, salary) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $id, $name, $email, $pass, $sal);

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

function updateSalary($id, $increment) 
{
    $con = con();

    $query = "SELECT Salary FROM ab WHERE ID = '$id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) == 1) 
    {
        $row = mysqli_fetch_assoc($result);
        $currentSalary = $row['Salary'];

        $updatedSalary = $currentSalary + ($currentSalary * ($increment / 100));

        $updateQuery = "UPDATE ab SET Increment = '$increment', Updated_Salary = '$updatedSalary' WHERE ID = '$id'";
        $updateResult = mysqli_query($con, $updateQuery);

        return $updateResult; 
    }

    return false;
}


?>