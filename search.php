<?php

$data= "k";

if (isset($_GET['q'])){
	$data = $_GET['q'];
}
// Create connection
$con = new mysqli("localhost", "root", "", "forumdb");

if ($db->connect_error){
	exit('db not found');
}

$x = " SELECT * FROM post_tbl WHERE title like '%$data%'";
$y = $db->query($x);

if ($y) {
	$z = $y->fetch_assoc();
	echo "<h1>" .$z['title']."</h1>";
}
?>