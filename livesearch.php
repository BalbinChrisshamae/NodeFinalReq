<?php
session_start();
require 'config.php';

$con;
$result = '';
if(isset($_POST['query'])){
    $search = $_POST['query'];

    $query =mysqli_query($con,"SELECT p.*, c.name as `category` FROM `post_tbl` p inner join category_tbl c on p.category_id = c.id where p.title like '%$search%' and p.status = 1  and p.`delete_flag` = 0 order by abs(unix_timestamp(p.created_at)) desc");
    if(mysqli_num_rows($query)>0){
        $result = '
        <div class="container" id="livesearch" style="margin-bottom: 50px;">
            <div class="row"><div class="container" id="livesearch" style="margin-bottom: 50px;">
            <div class="row">';
                $query =mysqli_query($con,"SELECT p.*, c.name as `category` FROM `post_tbl` p inner join category_tbl c on p.category_id = c.id where p.title like '%$search%' and p.status = 1  and p.`delete_flag` = 0 order by abs(unix_timestamp(p.created_at)) desc");
                while($row = mysqli_fetch_assoc($query)){
              
        $result .= "<div class='col-md-4'>
                  <div class='card zoom'>
                  <a href='post.php?id=".$row['id']."'>
                    <div class='card-body'>
                      <span class='mb-2 text-right'>".$row['category']."</span>
                      <h5 class='card-title'>".$row['title']."</h5>
                      <p class='card-text'>".strip_tags($row['content'])."</p>
                      <p class='card-text'><small class='text-muted'>".date('Y-m-d h:i A', strtotime($row['created_at']))."</small></p>
                    </div>
                  </a>
                  </div>
                </div>";
            }  
        $result .='</div>
          </div>';
        echo $result;
    }
    else{
        $result = '
        <div class="container" id="livesearch" style="margin-bottom: 50px;">
            <div class="row"><div class="container" id="livesearch" style="margin-bottom: 50px;">
            <div class="row">';
        $result .='<p>No record found</p></div></div></div>';
        echo $result;
    }
}
?>