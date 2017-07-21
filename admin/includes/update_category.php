<form action="" method="post">
    <div class="form-group">        
        <label for="cat_title">Edit Category</label>

        <?php 
        if(isset($_GET['edit'])){
        $get_cat_id=$_GET['edit'];
        $query="SELECT * FROM categories WHERE cat_id = {$get_cat_id}";
        $edit_query_result=mysqli_query($connection,$query);
        if(!$edit_query_result){
        die("Edit query failed ".mysqli_error($connection));
        }else{
        while($row=mysqli_fetch_assoc($edit_query_result)){
        $cat_title=$row['cat_title'];
        $cat_id=$row['cat_id'];


        ?> 
        <input value="<?php if(isset($cat_title)) echo $cat_title; ?>" class="form-control" type="text" name="cat_title">  
        <?php  } }} ?>
        <?php
        if(isset($_POST['update'])){
        //print_r($_POST);
        //$get_cat_id=$_GET['edit'];
        $get_cat_title=$_POST['cat_title'];
        $query=" UPDATE categories SET cat_title = '{$get_cat_title}' WHERE cat_id = {$cat_id} ";
        $edit_query_result=mysqli_query($connection,$query);
        if(!$edit_query_result){
        die("edit query failed ".mysqli_error($connection));
        }

        //JUST to refresh the page after DEleting

          header("Location: categories.php");
        }                                   

        ?>



    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Update Category" name="update">
    </div>

</form>
