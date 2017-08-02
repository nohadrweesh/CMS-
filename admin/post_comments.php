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
                            <small>Author</small>
                        </h1>
                           

                             <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response To</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                               
<?php
                                if(isset($_GET['p_id'])){
                                    $get_post_id=$_GET['p_id'];
                                
 $query="SELECT * FROM comments WHERE comment_post_id = $get_post_id ";
    $select_all_from_comments=mysqli_query($connection,$query);
if(!$select_all_from_comments){
    die("Query failed".mysqli_error($connection));

}
    while($row=mysqli_fetch_assoc($select_all_from_comments)){
    
    $comment_id=$row['comment_id'];
    $comment_post_id=$row['comment_post_id'];
    $comment_author=$row['comment_author'];
    $comment_date=$row['comment_date'];
    
    $comment_status=$row['comment_status'];
    $comment_email=$row['comment_email'];
    $comment_content=$row['comment_content'];
        
        echo "<tr>";
    echo "<td>$comment_id</td>";
    echo "<td>$comment_author</td>";
    echo "<td>$comment_content</td>";
    echo "<td>$comment_email</td>";
    echo "<td>$comment_status</td>";

 $query="SELECT * FROM posts WHERE post_id = $comment_post_id" ;
$result=mysqli_query($connection,$query);
 if(!$result){
    die("Query failed".mysqli_error($connection));

}
 while($row=mysqli_fetch_assoc($result)){
     $post_title=$row['post_title'];
     
      echo "<td><a href='../post.php?p_id=$comment_post_id'>$post_title</a></td>";
 }   
    
    

   
        
    echo "<td>$comment_date</td>";
        
        //echo CATEGORY NAME INSTEAD OF ID
    /*$query="SELECT * FROM categories where cat_id={$post_category_id}" ;
        $result=mysqli_query($connection,$query);
        confirmQuery($result);
        while($row=mysqli_fetch_assoc($result)){
            $category_title=$row['cat_title'];
        }*/
        
        
   
        echo "<td><a href='post_comments.php?p_id=$comment_post_id&approve=$comment_id'>Approve</a> </td>";
    echo "<td><a href='post_comments.php?p_id=$comment_post_id&unapprove=$comment_id'>Unapprove</a> </td>";
    
    echo "<td><a  href='post_comments.php?p_id=$comment_post_id&delete=$comment_id'>Delete</a> </td>";
        echo "</tr>";
    //echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
    //echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td></tr>";
    }            
                                }
?>
                               <!-- <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                -->
                            </tbody>
                        </table>
<?php
//UNAPPROVING
if(isset($_GET['unapprove'])){
    
    $get_comment_id=$_GET['unapprove'];
    
    $query=" UPDATE  comments SET comment_status='unapproved' WHERE comment_id = {$get_comment_id}";
    $unapprove_query_result=mysqli_query($connection,$query);
    confirmQuery($unapprove_query_result);
      header("Location: post_comments.php?p_id=$comment_post_id");
}

//APPROVING
if(isset($_GET['approve'])){
    
    $get_comment_id=$_GET['approve'];
    
    $query=" UPDATE  comments SET comment_status='approved' WHERE comment_id = {$get_comment_id}";
    $approve_query_result=mysqli_query($connection,$query);
    confirmQuery($approve_query_result);
    header("Location: post_comments.php?p_id=$comment_post_id");
}


//DELETING COMMENT
if(isset($_GET['delete'])){
    
    $get_comment_id=$_GET['delete'];
    
    $query=" DELETE FROM comments WHERE comment_id = {$get_comment_id}";
    $delete_query_result=mysqli_query($connection,$query);
    confirmQuery($delete_query_result);
    header("Location: post_comments.php?p_id=$comment_post_id");
}


?>                        
                       
            
                        </div>
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

 <?php include"includes/admin_footer.php";?>                     
                     
                    