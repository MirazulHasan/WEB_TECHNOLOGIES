<?php
require_once('../Models/alldb.php');
session_start();
if (empty($_SESSION['id'])) 
{
    header("location:../Views/login.php");
}

$res = data2();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        a:hover 
        {
            text-shadow: 0 0 5px #4CAF50, 0 0 10px #4CAF50, 0 0 15px #4CAF50;
            color: #f2f2f2;
        }

        button:hover 
        {
            box-shadow: 0 0 10px 5px rgba(76, 175, 80, 0.5);
        }
    </style>
</head>
<body>
    <div style="width: 650px auto; margin: 20px auto; border: 1px solid #ccc; padding: 20px; background-color: #fff; text-align: center;">
        <fieldset>
            <h1>Home page</h1>
            <h3>Welcome, <?php echo $_SESSION['id']; ?></h3>

            <table border="1" style="margin: 0 auto; width: 100%; text-align: center;">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Salary</th>
                    <th>Increment (%)</th>
                    <th>Updated Salary</th>
                    <th colspan="2">Options</th>
                </tr>
                <?php while($r = $res->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $r['ID']; ?></td>
                    <td><?php echo $r['Name']; ?></td>
                    <td><?php echo $r['Email']; ?></td>
                    <td><?php echo $r['Salary']; ?></td>

                    <form action="../Controllers/updateIncrementController.php" method="post">
                        <td>
                            <input type="number" name="increment" value="<?php echo $r['Increment']; ?>" min="0" required>
                            <input type="hidden" name="id" value="<?php echo $r['ID']; ?>">
                        </td>
                        <td><?php echo $r['Updated_Salary']; ?></td>
                        <td>
                            <button type="submit" name="update">Generate</button>
                        </td>
                    </form>

                    <form action="../Controllers/homeController.php" method="get">
                        <td><button name="delete" value="<?php echo $r['ID']; ?>">Delete</button></td>
                    </form>
                </tr>
                <?php } ?>
            </table>

            <?php 
            if (isset($_SESSION['mes'])) 
            {
                echo $_SESSION['mes'];
                unset($_SESSION['mes']);
            }
            ?>

            <br>

            <form action="../Controllers/insertDataController.php">
                <button name="insert"; style="display: inline-block; padding: 10px 20px; background-color: #6F0047; color: #fff; text-decoration: none; border-radius: 5px;">Insert Data</button>
            </form>

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
    </div>
</body>

</html>
