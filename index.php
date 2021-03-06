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
                $per_page=3;
                if(isset($_GET['page'])){
                    $page_num=$_GET['page'];
//                    $u=($page_num*5)-5;
//                     $query="SELECT * FROM posts WHERE post_status='published' ORDER BY post_id DESC  LIMIT $u,5 ";
//                    echo $query;
                }else{
                     $page_num="";
                }
                if( $page_num=="" ||  $page_num==1){
                    $page_1=0;
                }else{
                    $page_1=($page_num*$per_page)-$per_page;
                }
                
                    $query="SELECT * FROM posts  WHERE post_status='published' ";
                     $posts_count_query=mysqli_query($connection,$query);
                    $posts_count=mysqli_num_rows($posts_count_query);
                     $posts_count=ceil($posts_count/5);
                  //  echo $posts_count;
                
                    $query="SELECT * FROM posts WHERE post_status='published' ORDER BY post_id DESC LIMIT $page_1,$per_page ";
                    $select_all_from_posts=mysqli_query($connection,$query);
                   $isPublishedPostsFound=false;
                    while($row=mysqli_fetch_assoc($select_all_from_posts)){
                        $isPublishedPostsFound=true;
                        //print($row);
                        $post_id=$row['post_id'];
                        $post_title=$row['post_title'];
                        $post_author=$row['post_author'];
                        $post_date=$row['post_date'];
                        $post_image=$row['post_image'];
                        $post_content=substr($row['post_content'],0,100)." ...";
                        $post_tags=$row['post_tags'];
                      ?>
                        
                        
                  
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id;?>"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?> </p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id;?>">
                        <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content;?></p>
                
                <a href="post.php?p_id=<?php echo $post_id;?>" class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                
<?php   }     ?>
         
<?php
 if(!$isPublishedPostsFound) {
     echo"<h1>No published posts found</h1>";
 }              
                
?>
                <!-- Pager -->
               

            </div>

            <!-- Blog Sidebar Widgets Column -->
          <?php include"includes/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>
        <ul class="pager">
            <?php
            for($i=1;$i<=$posts_count;$i++){
                if($i==$page_num){
                     echo "<li '><a class='active-link' href='index.php?page={$i}'>{$i}</a></li>";
                }else{
                     echo "<li '><a href='index.php?page={$i}'>{$i}</a></li>";
                }
               
            }
            
            
            
            ?>
        </ul>

       <?php include"includes/footer.php";?>