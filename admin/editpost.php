<?php
session_start();
require '../config.php';

$con;

if(isset($_POST['newtopic'])){
  $title = $_POST['topic'];
  $userid = $_POST['userid'];
  $category = $_POST['category'];
  $content = $_POST['content'];
  $status = $_POST['status'];

  $query = mysqli_query($con, "UPDATE post_tbl SET user_id=$userid, category_id=$category, title='$title', content='$content', status='$status' WHERE id='".$_GET['id']."'");

  if($query){
    header("Location:post.php");
  }
  else{
    echo 'Error';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <title>Forum - Update topic</title>

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
  margin-top: 5px;
  width: 100%;
  height: 65px;
  background: #fff;
  padding: 0 50px;
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
  color: black;
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
  box-shadow: 0 0 3px #CC885E, 0 0 7px #CC885E, 0 0 20px #dee2e6;;
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

</style>
  <body>
    <div class="container my-3">
      
      <div class="row">
        <div class="col-12">
          <h2 class="h4 text-white bg-info mb-3 p-4 rounded">Update topic</h2>
          <?php
            $ano = "";
          $query = mysqli_query($con,"SELECT a.*,b.username,c.id as catid,c.name FROM post_tbl a INNER JOIN user_tbl b on a.user_id = b.id INNER JOIN category_tbl c on a.category_id=c.id WHERE a.id='".$_GET['id']."'");
          while($rowspost = mysqli_fetch_assoc($query)){
            if($rowspost['status'] == 1){
                $ano = "checked";
            }
            else{
                $ano = "";
            }
        ?>
          
          <form action="" method="POST" class="mb-3">
            <div class="form-group">
              <label for="topic">Topic:</label>
              <input type="hidden" value="<?php echo $rowspost['user_id'];?>" name="userid">
              <input type="text" class="form-control" value="<?php echo $rowspost['title'];?>" id="topic" name="topic" placeholder="Give your topic a title." required>
            </div>
            <div class="form-group">
              <label for="topic">Category:</label>
              <select class="form-control" name="category" id="cars">
              <option value="<?php echo $rowspost['catid'];?>"><?php echo $rowspost['name'];?></option>
                <?php
                $query = mysqli_query($con, "SELECT * FROM category_tbl");
                if(mysqli_num_rows($query)>0){
                  while($rows = mysqli_fetch_assoc($query)){
                    echo '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
                  }
                }
                else{
                  echo '<option disabled selected>No Category found.</option>';
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="comment">Content:</label>
              <textarea class="form-control" name="content" rows="10" placeholder="Write your content here." required><?php echo $rowspost['content'];?></textarea>
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input sdf" id="status_checkbox" name="status" value="<?php echo $rowspost['status'];?>" <?php echo $ano;?>>
              <label class="form-check-label" for="checkbox">Published</label>
            </div>
            <button type="submit" class="btn btn-primary" name="newtopic">Create topic</button>
            <button type="reset" class="btn btn-danger">Reset</button>
          </form>
          <?php }?>
        </div>
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
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#status_checkbox').click(function() {
          if ($("#status_checkbox").is(":checked") == true) {
            $('.sdf').val("1");
          }
          else {
            $('.sdf').val("0");
          }
        });
      });

    </script>
  </body>
</html>