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


?>