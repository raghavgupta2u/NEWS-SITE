<?php
include 'config.php';
$p_id = $_GET['id'];
$sql = "DELETE FROM post WHERE post_id = {$p_id}";
$result = mysqli_query($con,$sql);
header("Location: http://localhost/news-site-cms/NEWS-SITE/admin/post.php");
?>