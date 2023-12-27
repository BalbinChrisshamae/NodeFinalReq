<?php
session_start();
require 'config.php';

$con;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<style>
    @import url("https://fonts.googleapis.com/css?family=Josefin+Sans|Mountains+of+Christmas&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  list-style: none;
  text-decoration: none;
  font-family: "Josefin Sans", sans-serif;
}

.wrapper .multi_color_border{
  width: 100%;
  height: 5px;
  background: linear-gradient(to right, #fff 0% , #fff 25%, #494949 25%, #494949 50%, #d4ba93 50%, #d4ba93 75%, #fff 75%, #fff 100%);
}

.wrapper .top_nav{
  margin-top: -15px;
  width: 100%;
  height: 65px;
  background: #fff;
  padding: 20px 50px 0px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.wrapper .top_nav .left{
  display: flex;
  align-items: center;
}

.wrapper .top_nav .left .logo p{
  font-size: 24px;
  font-weight: bold;
  color: #494949;
  font-family: "Mountains of Christmas", cursive;
  margin-right: 25px;
}

.wrapper .top_nav .left .logo p span{
  color: burlywood;
  font-family: "Mountains of Christmas", cursive;
}

.wrapper .top_nav .left .search_bar input[type="text"]{
  border: 1px solid #666666;
  padding: 5px 10px; 
  outline: none;
  transition: all 0.5s linear;
}

.wrapper .top_nav .left .search_bar input[type="text"]:focus{
  width: 250px;
}

.wrapper .top_nav .right ul{
  display: flex;
}

.wrapper .top_nav .right ul li{
  margin: 0 12px;
}

.wrapper .top_nav .right ul li:last-child{
  background: #494949;
  margin-right: 0;
  border: 2px solid #EFEEF1;
  border-radius: 10px;
  letter-spacing: 3px;
}

.wrapper .top_nav .right ul li:hover:last-child{
  background: #494949;
  color: #fff;
}

.wrapper .top_nav .right ul li a{
  display: block;
  padding: 8px 10px;
  color: #666666;
}

.wrapper .top_nav .right ul li:last-child a{
   color: black;
}

.wrapper .bottom_nav{
  width: 100%;
  background: #f9f9f9;
  height: 45px;
  padding: 0 100px;
}

.wrapper .bottom_nav ul{
  width: 100%;
  height: 45px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.wrapper .bottom_nav ul li a{
  color: #494949;
  letter-spacing: 2px;
  text-decoration: none;
  background: transparent;
  padding: 15px 25px;
  border-radius: 30px;
  font-weight: bold;
  transition: all 0.3s ease-in-out;
  border: 1px solid #fff;
  text-transform: uppercase;
  font-size: 12px;
}
.wrapper .bottom_nav ul li a:hover{
  border: 0;
  box-shadow: 0 0 3px #CC885E, 0 0 7px #CC885E, 0 0 20px #dee2e6;
}
.btn-active{
  border: 0;
  box-shadow: 0 0 3px #CC885E, 0 0 7px #CC885E, 0 0 20px #dee2e6;
}
.wrapper .banner img{
    margin-left: 25%;
    margin-right: 25%;
    height: 500px;
    width: 50%;
}
.search_wrap{
	width: 500px;
	margin: 38px auto;
}

.search_wrap .search_box{
	position: relative;
	width: 500px;
	height: 60px;
}

.search_wrap .search_box .input{
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	padding: 10px 20px;
	border-radius: 3px;
	font-size: 18px;
}

.search_wrap .search_box .btn{
	position: absolute;
	top: 0;
	right: 0;
	width: 60px;
	height: 100%;
	background: #fff;
	z-index: 1;
	cursor: pointer;
}


.search_wrap .search_box .btn.btn_common .fas{
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-50%);
	color: #fff;
	font-size: 20px;
}
.search_wrap.search_wrap_6 .search_box .input{
	border-radius: 50px;
}
.search_wrap.search_wrap_6 .search_box .btn{
  width: 125px;
	height: 45px;
	top: 8px;
	right: 5px;
	border-radius: 3px;
	color: #fff;
	display: flex;
	align-items: center;
	justify-content: center;
}
.search_wrap.search_wrap_6 .search_box .btn{
	border-radius: 25px;
}
.search_wrap.search_wrap_6 .search_box .input{
	padding-right: 145px;
}

/* zoom hover */
.zoom {
  transition: transform .5s;
}

.zoom:hover {
  -ms-transform: scale(1.1); /* IE 9 */
  -webkit-transform: scale(1.1); /* Safari 3-8 */
  transform: scale(1.1); 
}
.card-body{
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}
.card-body:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.container .row a{
  text-decoration: none;
  color: black;
}
.wrapper .carousel-inner .carousel-item img{
  width: 70%;
  height: 20%;
  margin-top: 9%;
  margin-left: 215px;

}
</style>

<!-- Modal -->
<?php

if(isset($_POST['savechanges'])){
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $uname = $_POST['uname'];
  $pass = $_POST['pass'];
  $conpass = $_POST['conpass'];
  $avatar = $_POST['fname'];

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

  $query = mysqli_query($con,"UPDATE user_tbl SET firstname='$fname', middlename='$mname', lastname='$lname', username='$uname', password='$pass', avatar='$imagename' WHERE id='".$_SESSION['user_id']."'");
  if($query){
    echo 'success';
    move_uploaded_file($imagetemp, $imagePath . $imagename);
  }
  
  else{
    echo 'error';
  }
  
}

if(isset($_SESSION['user_id'])){

$query = mysqli_query($con,"SELECT * FROM user_tbl WHERE id='".$_SESSION['user_id']."'");
while($row = mysqli_fetch_assoc($query)){?>
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" class="form-control" name="fname" value="<?php echo $row['firstname'];?>" id="exampleInputEmail1" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input type="texst" class="form-control" name="mname" value="<?php echo $row['middlename'];?>" id="exampleInputPassword1">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" class="form-control" name="lname" value="<?php echo $row['lastname'];?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Username</label>
          <input type="text" class="form-control" name="uname" value="<?php echo $row['username'];?>" id="exampleInputPassword1" >
        </div>
        <div class="form-group">
        <label for="exampleFormControlFile1">Your Avatar</label>
        <input type="file" class="form-control-file" name="avatar" id="exampleFormControlFile1">
        <br>
        <img src="avatar_images/<?php echo $row['avatar'];?>" width="auto" height="60" />
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" name="pass" value="<?php echo $row['password'];?>" id="exampleInputPassword1" >
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Confirm Password</label>
          <input type="password" class="form-control" name="conpass" id="exampleInputPassword1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="savechanges" class="btn btn-primary">Save changes</button>
      </div>
      </form>
      <?php }}?>
    </div>
  </div>
</div>
<body>
    <div class="wrapper">
      <?php
      if(isset($_SESSION['user_id'])){?>
        <nav class="navbar fixed-top">
          <div class="top_nav">
              <div class="left">
                <span><img src="images/sound.gif" height="80px" width="80px"></span>
                <div class="logo"><p><span>World</span>Sound</p></div>
              </div> 
            <div class="right">
              <ul>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <?php
                  $query = mysqli_query($con,"SELECT * FROM user_tbl WHERE id='".$_SESSION['user_id']."'");
                  while($row = mysqli_fetch_assoc($query)){
                ?>
                  <img src="avatar_images/<?php echo $row['avatar'];?>" width="40" height="40" class="rounded-circle" />
                <?php }?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#"><?php echo $_SESSION['username'];?></a>
                  <a class="dropdown-item" style="cursor:pointer" data-toggle="modal" data-target="#exampleModal">Edit Profile</a>
                  <a class="dropdown-item" href="logout.php">Log Out</a>
                </div>
                </li>   
                </ul>
            </div>
          </div>
          <div class="bottom_nav">
            <ul>
              <li><a href="#" class="btn-active">Home</a></li>
              <li><a href="about.php">About Us</a></li>
              <li><a href="new-topic.php">Add Post</a></li>
            </ul>
          </div><br/>
        </nav>  
      <?php }
      else{ ?>
        <nav class="navbar fixed-top">
        <div class="top_nav">
            <div class="left">
              <br>
              <span><img src="images/sound.gif" height="80px" width="80px"></span>
              <div class="logo"><p><span>World</span>Sound</p></div>
            </div> 
          <div class="right">
            <ul>
              <li><a href="login.php" style="text-decoration:none;">LogIn</a></li>
              <li><a href="registration.php" style="text-decoration:none;">SignUp</a></li>
              </ul>
          </div>
        </div>
        <div class="bottom_nav">
          <ul>
            <li><a href="#" class="btn-active">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="new-topic.php">Add Post</a></li>
          </ul>
        </div><br/>
      </nav>  
      <?php }
      ?>
      <div id="demo" class="carousel slide" style="width: 100%" data-ride="carousel">

<!-- Indicators -->
<ul class="carousel-indicators">
  <li data-target="#demo" data-slide-to="0" class="active"></li>
  <li data-target="#demo" data-slide-to="1"></li>
  <li data-target="#demo" data-slide-to="2"></li>
</ul>

<!-- The slideshow -->
<div class="carousel-inner">
  <div class="carousel-item active">
    <img src="images/background1.jpg" alt="Piano">
    
  </div>
  <div class="carousel-item">
    <img src="images/background2.jpg" alt="guitar">
   
  </div>
  <div class="carousel-item">
    <img src="images/background3.jpg" alt="Guitar">
  </div>
</div>

<!-- Left and right controls -->
<a class="carousel-control-prev" href="#demo" data-slide="prev">
  <span class="carousel-control-prev-icon" style="background-color: #000000;"></span>
</a>
<a class="carousel-control-next" href="#demo" data-slide="next">
  <span class="carousel-control-next-icon" style="background-color: #000000;"></span>
</a>

</div>
      <div class="container-fluid" style="margin-top: 170px;">
        
        <div class="search_wrap search_wrap_6">
          <div class="search_box">
            <input type="search" class="input" id="search" placeholder="Search post here">
            <div class="btn">
              &nbsp;&nbsp;&nbsp;&nbsp;<box-icon name='search'></box-icon>
            </div>
          </div>
        </div>
      </div>  
    </div> 

    <div class="container" id="livesearch" style="margin-bottom: 50px;">
      <div class="row">
        <?php
          $query =mysqli_query($con,"SELECT p.*, c.name as `category` FROM `post_tbl` p inner join category_tbl c on p.category_id = c.id where p.status = 1  and p.`delete_flag` = 0 order by abs(unix_timestamp(p.created_at)) desc");
                      while($row = mysqli_fetch_assoc($query)):
        ?>
        
          <div class="col-md-4">
            <div class="card zoom mb-3">
            <a href="post.php?id=<?php echo $row['id'];?>">
              <div class="card-body">
               <div class="text-right"><h6 class="badge badge-light border text-dark rounded-pill px-3"><i class="far fa-circle"></i> <?= $row['category'] ?></h6></div>
                <h5 class="card-title"><?= $row['title'] ?></h5>
                <p class="card-text"><?= strip_tags($row['content']) ?></p>
                <p class="card-text text-right font-italic"><small class="text-muted"><?= date("Y-m-d h:i A", strtotime($row['created_at'])) ?></small></p>
              </div>
            </a>
            </div>
          </div>
        
        <?php endwhile; ?>  
      </div>
    </div>

      <footer class="medium bg-dark text-white">
        <div class="container py-4">
          <ul class="list-inline mb-0 text-center">
            <li class="list-inline-item">&copy; 2022</li>
            <li class="list-inline-item">All rights reserved.</li>
            <li class="list-inline-item"><a href="#">Terms of use and privacy policy</a>.</li>
          </ul>
          <ul class="list-inline mb-0 text-center">
          <li class="list-inline-item">Developed by: Group 10</li>
        </div>
      </footer>
  
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
     <script src="js2/jquery.min.js"></script>
     <script src="js2/bootstrap.min.js"></script>
</body>
</html>
<script>
  $(document).ready(function(){
    $("#search").keyup(function(){
      var search = $(this).val();
      $.ajax({
        url:"livesearch.php",
        method: "POST",
        data:{query:search},
        success:function(res){
          $("#livesearch").html(res);
        }
      })
    })
  });

</script>