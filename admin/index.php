<?php include"includes/admin_header.php";?>

    <div id="wrapper">
   


        <!-- Navigation -->
        
<?php include"includes/admin_navigation.php";?>
       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin area
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
                
                                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
<?php
$query="SELECT * FROM posts";
$select_posts_query=mysqli_query($connection,$query);
$posts_count=mysqli_num_rows($select_posts_query);
echo"<div class='huge'>$posts_count</div>" ;
?>
                                        
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                   <a href="posts.php">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        
<?php
$query="SELECT * FROM comments";
$select_comments_query=mysqli_query($connection,$query);
$comments_count=mysqli_num_rows($select_comments_query);
echo"<div class='huge'>$comments_count</div>" ;
?>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                   <a href="comments.php">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
<?php
$query="SELECT * FROM users";
$select_users_query=mysqli_query($connection,$query);
$users_count=mysqli_num_rows($select_users_query);
echo"<div class='huge'>$users_count</div>" ;
?>
                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                   <a href="users.php">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
<?php
$query="SELECT * FROM categories";
$select_categories_query=mysqli_query($connection,$query);
$categories_count=mysqli_num_rows($select_categories_query);
echo"<div class='huge'>$categories_count</div>" ;
?>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                   <a href="categories.php">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                       <div class="clearfix"></div>
                                       </a>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
<?php
    $query="SELECT * FROM posts WHERE post_status='draft'";
$select_draft_posts_query=mysqli_query($connection,$query);
$draft_posts_count=mysqli_num_rows($select_draft_posts_query);  
                
  $query="SELECT * FROM comments WHERE comment_status='unapproved'";
$select_pending_comments_query=mysqli_query($connection,$query);
$pending_comments_count=mysqli_num_rows($select_pending_comments_query);                  
                
 $query="SELECT * FROM users WHERE user_role='subscriber'";
$select_subscribers_query=mysqli_query($connection,$query);
$subscribers_count=mysqli_num_rows($select_subscribers_query);                  
                
?>
         
           
               <!--CHARTS-->
           <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'count'], 
            <?php
            $element_text=['Active Posts','Draft Posts','Comments','Pending Comments','Users','Subscribers','Categories'];
    $element_count=[$posts_count,$draft_posts_count,$comments_count,$pending_comments_count,$users_count,$subscribers_count,$categories_count];
           // $element_count=[4,5,2,3];
            
            for($i=0;$i<count($element_text);$i++){
                echo "['{$element_text[$i]}'" . "," ."{$element_count[$i]}],";
               //if($i!=3)echo",";
            }
            
            ?>
         // ['2017', 1000]
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
           <div id="columnchart_material" style="width: auto; height: 500px;"></div>
            </div>
            <!-- /.container-fluid -->

 <?php include"includes/admin_footer.php";?>