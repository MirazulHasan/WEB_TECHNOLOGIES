<?php
require_once('../Models/alldb.php');
session_start();
$res = data($_SESSION['id']);
$r = $res->fetch_assoc()
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
    <style>
        a:hover {
            text-shadow: 0 0 5px #4CAF50, 0 0 10px #4CAF50, 0 0 15px #4CAF50;
            color: #f2f2f2;
        }

        button:hover {
            box-shadow: 0 0 10px 5px rgba(76, 175, 80, 0.5);
        }
    </style>
</head>
<body>
   <div style="width: 400px; margin: 20px auto; border: 1px solid #ccc; padding: 20px; background-color: #fff; text-align: center;">
        <form method="post" action="../Controllers/loginCheckController.php"> 
            <fieldset>
                <legend><h1>Employee Details</h1></legend>
                
                <h3>Welcome, <?php echo $r['Name']; ?></h3>

                <table border="1" style="margin: 0 auto; text-align: center;">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Salary</th>
                    </tr>
                    
                    <tr>
                        <td><?php echo $r['ID']; ?></td>
                        <td><?php echo $r['Name']; ?></td>
                        <td><?php echo $r['Email']; ?></td>
                        <td><?php if (!empty($r['Updated_Salary']))
                        {
                            echo $r['Updated_Salary']; 
                        } 
                        else 
                        {
                            echo $r['Salary']; 
                        }?></td>
                    </tr>
                    
                </table>

                <?php 
                if (isset($_SESSION['mes'])) 
                {
                    echo $_SESSION['mes'];
                    unset($_SESSION['mes']);
                }
                ?>
                
                <br>
                <form action="../Controllers/loginCheckController.php">
                    <button name="logout"; style="display: inline-block; padding: 10px 20px; background-color: #6F0047; color: #fff; text-decoration: none; border-radius: 5px;">Logout</button>
                </form>
                
                <?php
                if (isset($_SESSION['success'])) 
                {
                    echo "<p style='color: green;'>" . $_SESSION['success'] . "</p>";
                    unset($_SESSION['success']);  
                }
                ?>

            </fieldset>
        </form>
    </div>

</body>

</html>
