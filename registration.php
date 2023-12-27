<?php 
require 'config.php';
$msg = "";
$con;

if(isset($_POST['register'])){
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $username = $_POST['username'];
  $pass = $_POST['pass'];
  $conpass = $_POST['conpass'];

  //saving file - Note: imagename must be the field to save in DB.
  $image = $_FILES['avatar'];
  //Stores the filename as it was on the client computer.
  $imagename = $_FILES['avatar']['name'];
  //Stores the filetype e.g image/jpeg
  $imagetype = $_FILES['avatar']['type'];
  //Stores any error codes from the upload.
  $imageerror = $_FILES['avatar']['error'];
  //Stores the tempname as it is given by the host when uploaded.
  $imagetemp = $_FILES['avatar']['tmp_name'];
  //The path you wish to upload the image to
  $imagePath = "avatar_images/";

  if($pass != $conpass){
    $msg = '<p style="color:red">Password not match!</p>';
  }
  else{
    move_uploaded_file($imagetemp, $imagePath . $imagename);

    $query = mysqli_query($con, "INSERT INTO user_tbl(firstname,middlename,lastname,username,password,avatar, type) VALUES('$fname','$mname','$lname','$username','$pass','$imagename', 0)");
    if($query){
     header("location:login.php");
    }
  }
  
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/reg.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action="registration.php" method="POST" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" name="fname" id="fname" required>
          </div>
          <div class="input-box">
            <span class="details">Middle Name</span>
            <input type="text" name="mname" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" name="lname" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" name="username" required>
          </div>
          <div class="input-box">
            <span class="details">Your avatar</span>
            <input type="file" class="upload-box" name="avatar" id="avatar" accept="image/png, image/jpeg">
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" name="pass" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" name="conpass" required>
            <?php echo $msg;?>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register" name="register">
        </div>
      </form>
    </div>
  </div>


</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
  </script>
</html>