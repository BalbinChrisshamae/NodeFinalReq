<?php
session_start();
require 'config.php';

$msg = "";
$con;

if(isset($_POST['signin'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    $query = mysqli_query($con, "SELECT * FROM user_tbl WHERE username = '$username' and password = '$password'");
    $row = mysqli_fetch_assoc($query);
    
    if(mysqli_num_rows($query) > 0){
        if($row['type'] == 1){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("location:admin/index.php");
        }
        else{
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("location:index.php");
        }
    }
    else{
        $msg = "<h5 class='h5 text-white' style='color:red'>Invalid Username and Password</h5>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form | Wavefire Coding</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <div class="main-wrap">
        <div class="box-container">
            <div class="img-box" data-aos="zoom-in" data-aos-duration="1000">

            </div>
            <div class="form-wrap">
                <div class="top-website">
                    <a href="index.php" class="website">Go to Website</a>
                </div>
                <div class="mid-container">
                    <h2>Welcome To World Sound</h2>
                    <h6>Login your Account</h6>
                    <?php echo $msg;?>
                    <form action="" class="form" method="POST" >
                        <label for="Username">Username</label></br>
                        <input type="text" name="username" id="" placeholder="username" required> 
                        </br></br>
                        <label for="Password">Password</label></br>
                        <input type="password" name="password" id="" placeholder="Your password" required>
                        <br>
                        <span><a href="registration.php" class="fg-pass">Create an Account</a></span>
                        <br>
                        <button type="submit" class="login-btn" name="signin">Sign In</button>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
</html>