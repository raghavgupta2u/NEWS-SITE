<?php
include 'config.php';
$p_id = $_GET['id'];
$c_id = $_GET['cat_id'];

$sql1 = "SELECT* FROM post WHERE post_id = {$p_id};";
$result1 = mysqli_query($con,$sql1);
$row =mysqli_fetch_assoc($result1);

//unlink("admin/upload/".$row['post_img']);

$sql = "DELETE FROM post WHERE post_id = {$p_id};";
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$c_id}";
$result = mysqli_multi_query($con,$sql);

header("Location: http://localhost/news-site-cms/NEWS-SITE/admin/post.php");
?>