<?php
if(isset($_GET['p_id'])){
    $get_post_id=$_GET['p_id'];
    
    $query="SELECT * FROM posts WHERE post_id={$get_post_id}";
    $select_all_from_posts=mysqli_query($connection,$query);

    while($row=mysqli_fetch_assoc($select_all_from_posts)){
       // $row=mysqli_fetch_assoc($select_all_from_posts)
    $post_title=$row['post_title'];
    $post_id=$row['post_id'];
    $post_category_id=$row['post_category_id'];
    $post_author=$row['post_author'];
    $post_date=$row['post_date'];
    $post_image=$row['post_image'];
    $post_comments_count=$row['post_comments_count'];
    $post_status=$row['post_status'];
    $post_tags=$row['post_tags'];
    $post_content=$row['post_content'];
    }
    if(isset($_POST['edit'])){
        $post_title=$_POST['title'];
        $post_category_id=$_POST['post_category'];
        $post_author=$_POST['post_author'];
        $post_status=$_POST['post_status'];

        $post_image=$_FILES['post_image']['name'];
        $post_image_temp=$_FILES['post_image']['tmp_name'];


        $post_tags=$_POST['post_tags'];
        $post_content=$_POST['post_content'];
        //$post_date=date('d-m-y');
        //$post_comment_count=4;

        move_uploaded_file($post_image_temp,"../images/$post_image");
        //FOR IMAGE DISPLAYING AFTER CLICKING ON EDIT BtN
        if(empty($post_image)){
            
            
            $query="SELECT * FROM posts WHERE post_id = $get_post_id";
            $select_image=mysqli_query($connection,$query);
            confirmQuery($select_image);
            while($row=mysqli_fetch_assoc($select_image)){
                //print_r($row);
                $post_image=$row['post_image'];
            }
            
        }

            $query="UPDATE posts SET ";
            $query.=" post_category_id='{$post_category_id}', ";
            $query.=" post_title='{$post_title}', ";
            $query.=" post_author='{$post_author}', ";
            $query.=" post_date=now(), ";
            $query.=" post_image='{$post_image}', ";
            $query.=" post_content='{$post_content}', ";
            $query.=" post_tags='{$post_tags}',";
           // $query.=" post_comments_count='{$post_comment_count}',";
            $query.=" post_status= '{$post_status}' ";
        $query.="WHERE post_id = '{$get_post_id}' ";
           
        $result=mysqli_query($connection,$query);
           confirmQuery($result);
        echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$get_post_id}'>View Post</a> or <a href='posts.php'>Edit other posts</a></p>";
    }
    
}

?>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
       <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
       <label for="post_category_id">Post Category </label>
        <select name="post_category" id="">
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
    
     <div class="form-group">
       <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>
    
    
    <div class="form-group">
       <label for="post_status">Post Status</label>
       
        <select name="post_status" id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
                if($post_status=='published'){
                    echo"<option value='draft'>draft</option>";
                }
               else{
                 echo "<option value='published'>puplished</option>";
               }
            ?>
        </select>
    </div>
    
    <div class="form-group">
       <img src="../images/<?php echo $post_image ?>" width="100px" alt="image">
       <input type="file"  name="post_image" >
    </div>
    
    
    
    <div class="form-group">
       <label for="post_tags">Post Tags</label>
        <input  value="<?php echo $post_tags; ?>"type="text" class="form-control" name="post_tags">
    </div>
    
    
    
    <div class="form-group">
       <label for="post_conent">Post Content</label>
        <textarea  type="text" class="form-control" name="post_content" cols="30" rows="10">
            <?php echo $post_content; ?>
        </textarea>
    </div>
     <div class="form-group">
       
        <input type="submit"  name="edit" class="btn btn-primary" value="Edit Post">
    </div>
    
    
</form>

