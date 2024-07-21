<?php include "header.php"; ?>
<?php
if (isset($_POST['submit'])) {
    include "config.php";

 if(isset($_FILES['fileToUpload'])){
    $errors = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_ext = strtolower(end(explode('.',$file_name)));
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions)=== false){
        $errors[] = "this extension file not allowed(jpeg,jpg,png)";
    }
    if($file_size>2097152){
        $errors[] = "file size must be 2mb or lower.";
    }

    if(empty($errors) == true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
        print_r($errors);
        die();
    }
    }
    session_start();
    $title = mysqli_real_escape_string($con, $_POST['post_title']);
    $des = mysqli_real_escape_string($con, $_POST['postdesc']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $date = date("d M,Y");
    $auther = $_SESSION['user_id'];
    

    $sql = "INSERT INTO post(title, description, category, post_date,author,post_img)
     VALUES('{$title}','{$des}','{$category}','{$date}',{$auther},'{$file_name}');";

    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}"; 

   if($result = mysqli_multi_query($con,$sql) or die('Query Faild')){
    header("Location: http://localhost/news-site-cms/NEWS-SITE/admin/post.php");
   }else{
    echo "<div class=''alert a;ert-danger'>Query failed</div>";
   }    
}
?>

  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                         
                          <select name="category" class="form-control">
                              <option value="" selected> Select Category</option>
                              <?php  
                          include "config.php";
                          $sql = "SELECT *FROM category";
                          $result = mysqli_query($con,$sql);
                          if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo"<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                            }
                          }
                          ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
