<?php
if($_SESSION["user_role"] == '0'){
    header("Location: http://localhost/news-site-cms/NEWS-SITE/admin/post.php");
    }
include 'config.php';
$u_id = $_GET['id'];
$sql = "DELETE FROM user WHERE user_id = {$u_id}";
$result = mysqli_query($con,$sql);
header("Location: http://localhost/news-site-cms/NEWS-SITE/admin/users.php");
?>