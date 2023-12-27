<?php
session_start();
require('../config.php');
$con;

$category_no = 0;
$query = mysqli_query($con,"SELECT count(id) as num FROM category_tbl");
$rows = mysqli_fetch_assoc($query);
$category_no = $rows['num'];

$user_no = 0;
$query = mysqli_query($con,"SELECT count(id) as num FROM user_tbl WHERE type=0");
$rows = mysqli_fetch_assoc($query);
$user_no = $rows['num'];

$publish_no = 0;
$query = mysqli_query($con,"SELECT count(id) as num FROM post_tbl WHERE status=1");
$rows = mysqli_fetch_assoc($query);
$publish_no = $rows['num'];

$unpublish_no = 0;
$query = mysqli_query($con,"SELECT count(id) as num FROM post_tbl WHERE status=0");
$rows = mysqli_fetch_assoc($query);
$unpublish_no = $rows['num'];


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
                            <a class="nav-link active" href="#">
                                <div class="sb-nav-link-icon"><i class="nav-icon fas fa-tachometer-alt fa-2x"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="post.php">
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
                        <h1 class="mt-4">WELCOME, <?php echo $_SESSION['username'];?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        
                            <div class="row">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-primary text-white mb-4">
                                        <h3 class="card-body" align="center"><?php echo $category_no;?></h3>
                                        <span class="card-body" align="center"><i class="nav-icon fas fa-th-list fa-3x"  style="color:black ;" ></i></span>
                                        <div class="card-body" align="center">Category List</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-success text-white mb-4">
                                        <h3 class="card-body" align="center"><?php echo $user_no;?></h3>
                                        <span class="card-body" align="center"><i class="fa-solid fa-users-gear fa-3x" style="color:black ;"></i></span>
                                        <div class="card-body" align="center">Registered Uses</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-info text-white mb-4">
                                        <h3 class="card-body" align="center"><?php echo $publish_no;?></h3>
                                        <span class="card-body" align="center"><i class="nav-icon fas fa-blog fa-3x" style="color:black;"></i></span>
                                        <div class="card-body" align="center">Published Post</div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-muted text-black mb-4">
                                        <h3 class="card-body" align="center"><?php echo $unpublish_no;?></h3>
                                        <span class="card-body" align="center"><i class="nav-icon fas fa-blog fa-3x" style="color:black;"></i></span>
                                        <div class="card-body" align="center">Unpublished Post</div>
                                    </div>
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
    </body>
</html>
