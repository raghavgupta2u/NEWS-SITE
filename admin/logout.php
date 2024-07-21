<?php
include "config.php";

session_start();
session_unset();
session_destroy();

header("Location: http://localhost/news-site-cms/NEWS-SITE/admin/index.php");
?>
