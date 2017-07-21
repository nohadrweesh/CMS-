<?php
if(isset($_GET['u_id'])){
    $get_user_id=$_GET['u_id'];
    
    $query="SELECT * FROM users WHERE user_id={$get_user_id}";
    $select_all_from_users=mysqli_query($connection,$query);

    while($row=mysqli_fetch_assoc($select_all_from_users)){
       // $row=mysqli_fetch_assoc($select_all_from_posts)
    
    $user_id=$row['user_id'];
    $username=$row['username'];
   
    $user_firstname=$row['user_firstname'];
    $user_lastname=$row['user_lastname'];
    $user_password=$row['user_password'];
    $user_email=$row['user_email'];
    $user_role=$row['user_role'];
    
    }
    if(isset($_POST['edit'])){
        
        $username=$_POST['username'];
        $user_firstname=$_POST['user_firstname'];
        $user_lastname=$_POST['user_lastname'];
        $user_password=$_POST['user_password'];
        $user_role=$_POST['user_role'];
        //$post_date=date('d-m-y');
        //$post_comment_count=4;

       // move_uploaded_file($post_image_temp,"../images/$post_image");
        //FOR IMAGE DISPLAYING AFTER CLICKING ON EDIT BtN
       /* if(empty($post_image)){
            
            
            $query="SELECT * FROM posts WHERE post_id = $get_post_id";
            $select_image=mysqli_query($connection,$query);
            confirmQuery($select_image);
            while($row=mysqli_fetch_assoc($select_image)){
                //print_r($row);
                $post_image=$row['post_image'];
            }*/
            
        }

          $query="UPDATE users SET ";
            $query.=" username='{$username}', ";
            $query.=" user_firstname='{$user_firstname}', ";
            $query.=" user_lastname='{$user_lastname}', ";
            $query.=" user_password='{$user_password}', ";
            $query.=" user_role='{$user_role}' ";
            $query.="WHERE user_id = '{$get_user_id}' ";
           
        $result=mysqli_query($connection,$query);
           confirmQuery($result);
    }
    

?>
 
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
       <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname;?>">
    </div>
    
    <div class="form-group">
       <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname;?>">
    </div>
    
    <div class="form-group">
       <label for="user_role">Select Options </label>
        <select name="user_role" id="">
         
          <option value="<?php echo $user_role;?>"><?php echo $user_role;?></option>
          <?php 
            if($user_role =='admin'){
                echo"<option value='subscriber'>subscriber</option>";
            }else{
                echo"<option value='admin'>admin</option>";
            }
            
            
            ?>
          
           
        </select>
    </div>
    
     <div class="form-group">
       <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>
    
    
    <div class="form-group">
       <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email;?>">
    </div>
    
    <div class="form-group">
       <label for="user_password">Password</label>
        <input type="text" class="form-control"  name="user_password" value="<?php echo $user_password;?>" >
    </div>
    
    
   
     <div class="form-group">
       
        <input type="submit"  name="edit" class="btn btn-primary" value="Update User">
    </div>
    
    
</form>

