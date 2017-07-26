 <?php
if(isset($_POST['checkBoxArray'])){
    //print_r( $_POST['checkBoxArray']);  array of ids
    
    foreach($_POST['checkBoxArray'] as $postValueID){
       $bulk_options= $_POST['bulk_options'];
        switch ($bulk_options){
                case'published':
                 case'draft':
                
                 $query="UPDATE posts SET post_status='{$bulk_options}' WHERE post_id = {$postValueID}";
                break;
                // case'draft':
                 case'clone':
                        $query="SELECT * FROM posts WHERE post_id= {$postValueID}";
                        $select_post_query=mysqli_query($connection,$query);
                        confirmQuery($select_post_query);
                        while($row=mysqli_fetch_assoc($select_post_query)){
                                $post_title=$row['post_title'];

                                $post_category_id=$row['post_category_id'];
                                $post_author=$row['post_author'];
                                $post_date=$row['post_date'];
                                $post_image=$row['post_image'];
                                //$post_comments_count=$row['post_comments_count'];
                                $post_status=$row['post_status'];
                                $post_tags=$row['post_tags'];
                                $post_content=$row['post_content'];

                        }
                        $query="INSERT INTO posts (post_title,post_category_id,post_author,post_date,post_image,post_status,post_tags,post_content) ";
                        $query.=" VALUES ('{$post_title}',{$post_category_id},'{$post_author}',now(),'{$post_image}','{$post_status}','{$post_tags}', '{$post_content}')";
//                         $clone_post_query=mysqli_query($connection,$query);
//                       if(!$clone_post_query){
//                           die("clone query failed ".mysqli_error($connection));
//                       }
                
                
                 break;
                 case'delete':
                $query="DELETE FROM posts WHERE post_id = {$postValueID} ";
                break;
        }
        $result=mysqli_query($connection,$query);
        confirmQuery($result);
        header("Location: ./posts.php");
    }
}
?>
 <form action="" method="post">
<table class="table table-bordered table-hover">
                           <div id="bulkOptionsContainer" class="col-xs-4">
                               <select name="bulk_options" id="" class="form-control">
                                   <option value="">Select Options</option>
                                   <option value="published">Publish</option>
                                   <option value="draft">Draft</option>
                                   <option value="clone">Clone</option>
                                   <option value="delete">Delete</option>
                               </select>
                           </div>
                           <div class="col-xs-4">
                               <input type="submit" value="Apply" class="btn btn-success">
                               <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
                           </div>
                           
                            <thead>
                                <tr>
                                   <th><input type="checkbox" id="checkAllBoxes"></th>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Views</th>
                                    <th>Date</th>
                                    <th>content</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                               
<?php
 $query="SELECT * FROM posts ORDER BY post_id DESC";
    $select_all_from_posts=mysqli_query($connection,$query);

    while($row=mysqli_fetch_assoc($select_all_from_posts)){
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
    $post_views_count=$row['post_views_count'];
        
        echo "<tr>";
        ?>
        <td><input class="checkBoxes" type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id;  ?>"></td>
        <?php
    echo "<td>$post_id</td>";
    echo "<td>$post_author</td>";
    echo "<td>$post_title</td>";
        
        //echo CATEGORY NAME INSTEAD OF ID
    $query="SELECT * FROM categories where cat_id={$post_category_id}" ;
        $result=mysqli_query($connection,$query);
        confirmQuery($result);
        while($row=mysqli_fetch_assoc($result)){
            $category_title=$row['cat_title'];
        }
        
        
    echo "<td>$category_title</td>";
    echo "<td>$post_status</td>";
    echo "<td><img width='100px' src='../images/$post_image'/></td>";
    echo "<td>$post_tags</td>";
    echo "<td>$post_comments_count</td>";
    echo "<td> <a href='posts.php?reset=$post_id'>$post_views_count</a></td>";
    echo "<td>$post_date</td>";
    echo "<td>$post_content</td>";
    echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a> </td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post'); \" href='posts.php?delete=$post_id'>Delete</a> </td>";
    echo "<td><a href='../post.php?p_id=$post_id'>View Post</a> </td>";
   // echo "<td><a href='posts.php?reset=$post_id'>Reset Views</a> </td>";
        echo "</tr>";
    //echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
    //echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td></tr>";
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
                        </form>
<?php

if(isset($_GET['delete'])){
    
    $get_post_id=mysqli_real_escape_string($connection,$_GET['delete']);
    
    $query=" DELETE FROM posts WHERE post_id = {$get_post_id}";
    $delete_query_result=mysqli_query($connection,$query);
    confirmQuery($delete_query_result);
    header("Location: posts.php");
}

if(isset($_GET['reset'])){
    
    $get_post_id=mysqli_real_escape_string($connection,$_GET['reset']);
    
    $query=" UPDATE posts  SET post_views_count =0 WHERE post_id = {$get_post_id}";
    $update_query_result=mysqli_query($connection,$query);
    confirmQuery($update_query_result);
    header("Location: posts.php");
}


?>                        
                       
                      
                     
                    