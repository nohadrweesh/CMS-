<?php include"includes/db.php";?>
<?php include"includes/header.php";?>
    <!-- Navigation -->
    <?php include"includes/navigation.php";?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
      <?php 
                if(isset($_GET['p_id'])){
                    $get_post_id=$_GET['p_id'];
                
                //INCREASE post commentsnum
                $query="UPDATE posts SET post_views_count=post_views_count+1  WHERE post_id=$get_post_id";
               $result=mysqli_query($connection,$query);
                if(!$result){
                    die("Query failed" .mysqli_error($connection));
                }
                    
                    $query="SELECT * FROM posts WHERE post_id = {$get_post_id}";
                    $select_all_from_posts=mysqli_query($connection,$query);
                    while($row=mysqli_fetch_assoc($select_all_from_posts)){
                        //print($row);
                        $post_title=$row['post_title'];
                        $post_author=$row['post_author'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=$row['post_content'];
                        $post_tags=$row['post_tags'];
                    
                      ?>
                        
                        
                  
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?> </p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>
                

                <hr>

                
<?php  }  } ?>
         

                <!-- Pager -->
                
                
<?php
if(isset($_POST['create_comment'])){
    $get_post_id=$_GET['p_id'];//index-->post
    
    $comment_author=$_POST['comment_author'];
    $comment_email=$_POST['comment_email'];
    $comment_content=$_POST['comment_content'];
    $query="INSERT INTO comments ( comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ({$get_post_id}, '{$comment_author}',' {$comment_email}', '{$comment_content}', 'unapproved', now() )";
    
     
    $result=mysqli_query($connection,$query);
    if(!$result){
        die("Query failed" .mysqli_error($connection));
    }
    
    //INCREASE post comments num
    $query="UPDATE posts SET post_comments_count=post_comments_count+1  WHERE post_id=$get_post_id";
   $result=mysqli_query($connection,$query);
    if(!$result){
        die("Query failed" .mysqli_error($connection));
    }
}                
                
?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                       <div class="form-group">
                           <label for="comment_author">Author</label>
                           <input type="text" class="form-control " name="comment_author" required>
                       </div>
                       <div class="form-group">
                           <label for="comment_email">Email</label>
                           <input type="text" class="form-control " name="comment_email" required>
                       </div>
                        <div class="form-group">
                           <label for="comment_content">Your comment</label>
                            <textarea name="comment_content" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>
                
<?php
$query="SELECT * FROM comments WHERE comment_post_id=$get_post_id";
$query.=" AND comment_status = 'approved' ";
$query.="ORDER BY comment_id DESC";
                
$result=mysqli_query($connection,$query);
if(!$result){
    die("query failed".mysqli_error($connection));
}
while($row=mysqli_fetch_assoc($result)){
    $comment_date=$row['comment_date'];
    $comment_content=$row['comment_content'];
    $comment_author=$row['comment_author'];

?>


                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;?>
                            <small><?php echo $comment_date;?></small>
                        </h4>
                       <?php echo $comment_content;?>
                    </div>
                </div>
                
                
                <?php
}
    
?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
          <?php include"includes/sidebar.php";?>
          
         


        </div>
        <!-- /.row -->
         
        <hr>
        

       <?php include"includes/footer.php";?>