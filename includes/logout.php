<?php include"db.php";?>
<?php session_start();//important to make session start all over the admin area?>
<?php 
//________CANCELING SESSION BT RESETINNG ALL VARS TO NULL______________
        $_SESSION['username']=null;
        $_SESSION['firstname']=null;
        $_SESSION['lastname']=null;
        $_SESSION['user_role']=null;
header("Location:  ../index.php")
        
     

?>