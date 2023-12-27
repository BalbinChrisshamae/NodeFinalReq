<?php 
session_start();
require '../config.php';
$con;

//ADD_TOPIC
if(isset($_POST['save'])){
  $title = $_POST['topic'];
  $userid = $_POST['userid'];
  $category = $_POST['category'];
  $content = $_POST['content'];
  $status = $_POST['status'];

  $query = mysqli_query($con, "INSERT INTO post_tbl(user_id, category_id, title, content, status) VALUES($userid,$category,'$title', '$content', '$status' )");

  if($query){
    header("Location:post.php");
  }
  else{
    echo 'Error';
  }
}

//DELETE_POST
if(isset($_POST['deletepost'])){
  $id = $_POST['deleteid'];
  $query = mysqli_query($con,"DELETE FROM post_tbl WHERE id='$id'");
  if($query){
    header("location:post.php");
  }
  else{
    echo 'Error';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ADMIN</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/style_admin.css" rel="stylesheet" />
        <link rel="icon" href="images/top_logo.jpg">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        
    </head>
        <!--ADD MODAL-->
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Topic</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
          <form action="#" method="POST">
        
            <label for="recipient-name" class="col-form-label">Title:</label>
            <input type="text" class="form-control" name="topic" id="recipient-name">
            <input type="hidden" value="<?php if(isset($_SESSION['user_id'])){ echo $_SESSION['user_id'];} else{}?>" name="userid">
            
          </div>
              <select class="form-control" name="category" id="cars">
              <option disabled selected>Select Category</option>
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
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Content:</label>
            <textarea class="form-control" id="message-text" name="content"></textarea>
          </div>
          <input class="form-check-input sdf" id="status_checkbox" name="status" value="0" type="checkbox">
        <label class="form-check-label" for="flexCheckDefault">
            Published
        </label>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" name="save">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Administrator</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link active" href="post.php">
                                <div class="sb-nav-link-icon"><i class="nav-icon fas fa-blog fa-2x"></i></div>
                                Post Management
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Post Management</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">List of Post</li>
                        </ol>
                        
                        <div class="card mb-4">
                            
                            <div class="card-body">
                            <div class="form-group">
                                      <div class="col-sm-12 d-flex">
                                        <button
                                          class="btn btn-success mx-auto mx-md-0 text-white"  data-bs-toggle="modal" data-bs-target="#AddModal" data-bs-whatever="@mdo">
                                          + Add New 
                                        </button>

                                      </div><br>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date Created</th>
                                            <th>User</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Date Created</th>
                                            <th>User</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <?php
                                    $i = 1;
                                    $query = mysqli_query($con,"SELECT a.*,b.username FROM post_tbl a INNER JOIN user_tbl b on a.user_id = b.id");
                                    
                                    $pub = "";
                                    if(mysqli_num_rows($query)>0){
                                        
                                        
                                        while($row = mysqli_fetch_assoc($query)){
                                            if($row['status'] == 1){
                                                $pub = '<p style="color:green">PUBLISHED</p>';
                                            }
                                            else{
                                                $pub = '<p style="color:red">UNPUBLISHED</p>';
                                            }
                                    ?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><?php echo $row['created_at'];?></td>
                                            <td><?php echo $row['username'];?></td>
                                            <td ><?php echo $row['title'];?></td>
                                            <td><?php echo $pub;?></td>
                                            <td align="center">
                                              <a class="btn btn-primary" href="editpost.php?id=<?php echo $row['id'];?>">Edit</a>
                                              <button type="button" class="btn btn-danger" data-target="#editpost" data-toggle="modal" onclick="deleteme(<?php echo $row['id'];?>)">Delete</a>
                                            </td>
                                        </tr>
                                        
                                        <?php }
                                    }
                                    else{ ?>
                                        <tr>
                                            <td colspan="6">No Record found.</td>
                                        </tr>
                                    <?php }
                                    ?>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="../js2/jquery.min.js"></script>
        <script src="../js2/bootstrap.min.js"></script>
    </body>
    

</html>
<!-- Modal -->
<div class="modal fade" id="editpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
      <form action="" method="POST" class="mb-3">
            <div class="form-group">
              <input type="hidden" id="deleteidpost" name="deleteid">
              <p>Are you sure you want to delete this record?</p>
            </div>
      </div>
      <div class="modal-footer">
      <button type="submit" name="deletepost" class="btn btn-primary">Yes</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
      </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    deleteme();
    $('#status_checkbox').click(function() {
          if ($("#status_checkbox").is(":checked") == true) {
            $('.sdf').val("1");
          }
          else {
            $('.sdf').val("0");
          }
        });
  });
  function deleteme(id){
    var id = id;
    $("#deleteidpost").val(id);
    console.log(id);
  }
</script>