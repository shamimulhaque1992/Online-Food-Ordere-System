<?php include('../config/constants.php')?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <form action="" method="POST">
        <h1>Employer Log in</h1>
        <?php
        
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        
        
        
        ?>
        <div class="inset">
            <p>
                <label for="email">USERNAME</label>
                <input type="text" name="username" placeholder="Enter Username">
            </p>
            <p>
                <label for="password">PASSWORD</label>
                <input type="password" name="password" placeholder="Enter Password">
            </p>
            <p>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me for 14 days</label>
            </p>
        </div>
        <p class="p-container">

            <input type="submit" name="submit" value="Log in">
        </p>
    </form>
</body>

</html>


<?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);


    //sql 

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";

    //execute query

    $res = mysqli_query($conn, $sql);

    //Counting the rows from database
    $count = mysqli_num_rows($res);
        if ($count == 1) 
        {
            $_SESSION['login'] = "<div class ='success text-center'>Login Successful...</div>";
            $_SESSION['user'] = $username;
            header('location:' . SITEURL . 'admin/');
        } 
        else 
        {
            $_SESSION['login'] = "<div class ='error text-center'>Incorrect Username or Password...</div>";
            header('location:' . SITEURL . 'admin/login.php');
        }

}







?>