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
                    $get_author_name=$_GET['author'];
                }
                
                    $query="SELECT * FROM posts WHERE post_author = '{$get_author_name}' ";
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
                    <a href="post.php?p_id=<?php echo $get_post_id;?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="#"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?> </p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id;?>">
                  <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content;?></p>
                <a href="post.php?p_id=<?php echo $get_post_id;?>" class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                
<?php  }   ?>
         

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
    
    //INCREASE post commentsnum
    $query="UPDATE posts SET post_comments_count=post_comments_count+1  WHERE post_id=$get_post_id";
   $result=mysqli_query($connection,$query);
    if(!$result){
        die("Query failed" .mysqli_error($connection));
    }
}        
                
?>
             

            </div>

            <!-- Blog Sidebar Widgets Column -->
          <?php include"includes/sidebar.php";?>
          
         


        </div>
        <!-- /.row -->
         
        <hr>
        

       <?php include"includes/footer.php";?>