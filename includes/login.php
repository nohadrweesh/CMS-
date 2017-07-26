<?php include"db.php";?>
<?php session_start();//important to make session start all over the admin area?>
<?php 
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    //--------TO AVOID INJECTION-----
    $username=mysqli_real_escape_string($connection,$username);
    $password=mysqli_real_escape_string($connection, $password);
    
    
    //SQL QUERY
    $query="SELECT * FROM users WHERE username='{$username}' ";
    $user_login_query=mysqli_query($connection,$query);
    if(!$user_login_query){
        die("Login Query Failed ".mysqli_error($connection));
    }
    while($row=mysqli_fetch_assoc($user_login_query)){
        $db_user_id=$row['user_id'];
        $db_username=$row['username'];
        $db_user_firstname=$row['user_firstname'];
        $db_user_lastname=$row['user_lastname'];
        $db_user_password=$row['user_password'];
        $db_user_role=$row['user_role'];
        //echo "soo";
    }
    
     //REVERSE ENCRYPTION
    $password=crypt($password,$db_user_password);
    //echo "soo";
    if($password==$db_user_password && $username==$db_username ){
        //set session vars
      //  echo "hii";
       // $_SESSION['username']=$db_username;
        $_SESSION['username']=$db_username;
        $_SESSION['firstname']=$db_user_firstname;
        $_SESSION['lastname']=$db_user_lastname;
        $_SESSION['user_role']=$db_user_role;
        
      header("Location: ../admin")  ;
    }else{
//echo "bye";
        header("Location: ../index.php")  ; 
    }
    
}

?>