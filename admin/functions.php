<?php 
function confirmQuery($result){
     global $connection;
     if(!$result){
        die("query failed ".mysqli_error($connection));
        }
}

function add_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title=$_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
        echo "This field should not be empty";
    }
    else{
        $query="INSERT INTO categories(cat_title) VALUES ('{$cat_title}')";
        $result=mysqli_query($connection,$query);
        if(!$result){
        die("query failed ".mysqli_error($connection));
        }
    }

    }
                            
}

function addAllCategories(){
    global $connection;
    $query="SELECT * FROM categories";
    $select_all_from_categories=mysqli_query($connection,$query);

    while($row=mysqli_fetch_assoc($select_all_from_categories)){
    $cat_title=$row['cat_title'];
    $cat_id=$row['cat_id'];
    echo "<tr><td>$cat_id</td>";
    echo "<td>$cat_title</td>";
    echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
    echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td></tr>";
    }
}

function deleteCategories(){
    global $connection;
    if(isset($_GET['delete'])){
    
    $get_cat_id=$_GET['delete'];
   $query=" DELETE FROM categories WHERE categories.cat_id = {$get_cat_id}";
    $delete_query_result=mysqli_query($connection,$query);
    if(!$delete_query_result){
        die("Delete query failed ".mysqli_error($connection));
    }
    
    //JUST to refresh the page after DEleting
    
    header("Location: categories.php");
}
}

function users_online(){
    global $connection;
     //catch user id in admin area every time we start a session
        
        $session=session_id();
        $time=time();
        $time_out_in_seconds=60;
        $time_out=$time-$time_out_in_seconds;
        
        $query="SELECT * FROM users_online WHERE session = '$session' ";
       $result= mysqli_query($connection,$query);
       // confirmQuery($result);
        if(!$result){
            die("failed".mysqli_error($connection));
        }
        $count=mysqli_num_rows($result);//how online 1 or 0
        //echo $count;
        if($count==NULL){
            $result=mysqli_query($connection,"INSERT INTO users_online (session,time) VALUES ('$session','$time') ");
            if(!$result){
                die("failed".mysqli_error($connection));
            }
        }else{//just update time
           mysqli_query($connection,"UPDATE users_online SET time-$time_out WHERE session='$session'  ");
            
            
            
        }//
        $users_online_query= mysqli_query($connection,"SELECT * FROM users_online WHERE time >'$time_out'  ");
       return  $users_count=mysqli_num_rows($users_online_query);
}


?>