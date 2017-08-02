<?php 
//if($connection)echo"good";
if(isset($_POST['submit'])){
    $post_title=$_POST['title'];
    $post_category_id=$_POST['post_category_id'];
    $post_author=$_POST['post_author'];
    $post_status=$_POST['post_status'];
    
    $post_image=$_FILES['post_image']['name'];
    $post_image_temp=$_FILES['post_image']['tmp_name'];
    
    
    $post_tags=$_POST['post_tags'];
    $post_content=$_POST['post_content'];
    $post_date=date('d-m-y');
    //$post_comment_count=4;
    
    move_uploaded_file($post_image_temp,"../images/$post_image");
    
    $query="INSERT INTO posts( post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,  post_status) VALUES  ({$post_category_id},'{$post_title}','{$post_author}' ,now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";
    $result=mysqli_query($connection,$query);
       confirmQuery($result);
    //---PULL UP THE LAST CREATED ID IN DB----------
    $get_post_id=mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$get_post_id}'>View Post</a> or <a href='posts.php'>Edit other posts</a></p>";
}

?>
   

   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
       <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
       <label for="post_category_id">Post Category </label>
        <select name="post_category_id" id="">
            <?php
            $query="SELECT * FROM categories";
            $result=mysqli_query($connection,$query);
            confirmQuery($result);
            while($row=mysqli_fetch_assoc($result)){
                $cat_id=$row['cat_id'];
                $cat_title=$row['cat_title'];
                echo "<option value='{$cat_id}'>$cat_title</option>";
            }
            ?>
           
        </select>
    </div>
    
     <!--<div class="form-group">
       <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>-->
    
     <div class="form-group">
       <label for="post_user">Post User </label>
        <select name="post_category_id" id="">
            <?php
            $query="SELECT * FROM users";
            $result=mysqli_query($connection,$query);
            confirmQuery($result);
            while($row=mysqli_fetch_assoc($result)){
                $user_id=$row['user_id'];
                $username=$row['username'];
                echo "<option value='{$user_id}'>$username</option>";
            }
            ?>
           
        </select>
    </div>
    
    
    <div class="form-group">
       <label for="post_status">Post Status</label>
        
        <select name="post_status" id="">
            <option value="published">published</option>
            <option value="draft">draft</option>
        </select>
    </div>
    
    <div class="form-group">
       <label for="post_image">Post Image</label>
        <input type="file"  name="post_image" >
    </div>
    
    
    
    <div class="form-group">
       <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    
    
    <div class="form-group">
       <label for="post_conent">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" cols="30" rows="10"></textarea>
    </div>
     <div class="form-group">
       
        <input type="submit"  name="submit" class="btn btn-primary" value="Publish Post">
    </div>
    
    
</form>