<?php include "header.php";
if($_SESSION["user_role"] == '0'){
    header("Location: http://localhost/news-site-cms/NEWS-SITE/admin/post.php");
    } ?>
 <?php
                if (isset($_POST['submit'])) {
                    include "config.php";
                    $category = mysqli_real_escape_string($con, $_POST['cat_name']);
                    $cat_id = mysqli_real_escape_string($con, $_POST['cat_id']);
                 
                        $sql = "UPDATE category SET category_name='{$category}' WHERE category_id= {$cat_id}";

                        if (mysqli_query($con,$sql)) {
                            header("location: http://localhost/news-site-cms/NEWS-SITE/admin/category.php");
                        }
                    }
                ?>     

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">

                <?php
                include "config.php";
                $cat_id = $_GET['id'];
                $sql = "SELECT * FROM category WHERE category_id = {$cat_id}";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['category_id'] ?>" >
                            </div>
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>" placeholder="" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>

                <?php } } ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>