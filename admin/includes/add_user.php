<?php 
//if($connection)echo"good";
if(isset($_POST['submit'])){
   
    
    $username=$_POST['username'];
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $user_password=$_POST['user_password'];
    
    //$user_image=$_FILES['user_image']['name'];
   // $user_image_temp=$_FILES['user_image']['tmp_name'];
    
    
    $user_email=$_POST['user_email'];
    $user_role=$_POST['user_role'];
    //$user_date=date('d-m-y');
    
    
    //move_uploaded_file($post_image_temp,"../images/$post_image");
    
    $query="INSERT INTO users(  username, user_password, user_firstname, user_lastname, user_email, user_role) VALUES  ('{$username}','{$user_password}' ,'{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}') ";
    $result=mysqli_query($connection,$query);
       confirmQuery($result);
}

?>
   

   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
       <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
       <label for="user_lastname">Lasttname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
       <label for="user_role">Select Options </label>
        <select name="user_role" id="">
          <option value="admin">Admin</option>
          <option value="subscriber">Subscriber</option>
           
        </select>
    </div>
    
     <div class="form-group">
       <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    
    
    <div class="form-group">
       <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
       <label for="user_password">Password</label>
        <input type="text" class="form-control"  name="user_password" >
    </div>
    
    
   
     <div class="form-group">
       
        <input type="submit"  name="submit" class="btn btn-primary" value="Add User">
    </div>
    
    
</form>