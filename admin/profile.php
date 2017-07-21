<?php include"includes/admin_header.php";?>
<?php include"functions.php";?>

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

<?php
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
    
    $query="SELECT * FROM users WHERE username= '{$username}' ";
    $select_user=mysqli_query($connection,$query);

    while($row=mysqli_fetch_assoc($select_user)){
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
        
            
        

          $query="UPDATE users SET ";
            $query.=" username='{$username}', ";
            $query.=" user_firstname='{$user_firstname}', ";
            $query.=" user_lastname='{$user_lastname}', ";
            $query.=" user_password='{$user_password}', ";
            $query.=" user_role='{$user_role}' ";
            $query.="WHERE user_id = '{$user_id}' ";
           
        $result=mysqli_query($connection,$query);
           confirmQuery($result);
    }
    
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
       
        <input type="submit"  name="edit" class="btn btn-primary" value="Update Profile">
    </div>
    
    
</form>

                        
                            
                        </div>
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

 <?php include"includes/admin_footer.php";?>