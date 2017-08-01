<?php include"includes/db.php"; ?>
<?php include"includes/header.php"; ?>
<?php
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $email=$_POST['email'];
    
    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection,$password);
    $email=mysqli_real_escape_string($connection,$email);
    
   
    
    $query="SELECT randSalt FROM users";
    $select_randsalt_query=mysqli_query($connection,$query);
    if(!$select_randsalt_query){
        die("fetch randSalt value query failed".mysqli_error($connection));
    }
    //echo mysqli_num_rows($select_randsalt_query); -->NUM OF USERS IN DB
     $password=password_hash($password,PASSWORD_BCRYPT,array('cost'=>10));
    
    
    //--------OLD PASSWORD ENCRYPTION--------
   /* $row=mysqli_fetch_array($select_randsalt_query);
    $salt=$row['randSalt'];
    
    //ENCRYPTION
    $password=crypt($password,$salt);
    */
    $query="INSERT INTO users (username,user_password,user_email,user_role) ";
    $query.=" VALUES ('{$username}','{$password}','{$email}','subscriber')";
    
    //echo $query;
    $register_user_query=mysqli_query($connection,$query);
    if(!$register_user_query){
        die("Register query failed ".mysqli_error($connection)/*mysqli_errno($connection)*/);
    }else{
        $message="Your registeration has been submitted sucessfully";
    }
    
}else{
    $message="";
}
?>
<!--Navigation-->
<?php include"includes/navigation.php"; ?>


<div class="container">
    <section id="login">
        <div class="container">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <h1>Register</h1>
                    
                    <form action="" role="form" method="post" id="login-form" autocomplete="off">
                       <?php echo "<h6 class='text-center'>$message</h6>";?>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input required type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input required type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input required type="password" name="password" id="key" class="form-control" placeholder="password">
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <!--Footer-->
<?php include"includes/footer.php"; ?>
    
</div>


