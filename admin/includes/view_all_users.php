 <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                   
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                               
<?php
     $query="SELECT * FROM users";
                               
    $select_all_from_users=mysqli_query($connection,$query);
 //echo $count=mysqli_num_rows($select_all_from_users);
                               
    while($row=mysqli_fetch_assoc($select_all_from_users)){
    
            $user_id=$row['user_id'];
            $username=$row['username'];
            $user_password=$row['user_password'];
            $user_firstname=$row['user_firstname'];
            $user_lastname=$row['user_lastname'];
            $user_email=$row['user_email'];
           // $user_image=$row['user_image'];
            $user_role=$row['user_role'];



                echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";



               echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_subscriber=$user_id'>Subscriber</a></td>";
            echo "<td><a  href='users.php?delete=$user_id'>Delete</a></td>";
            echo "<td><a href='users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
            //echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td></tr>";
                echo "</tr>";
                
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
<?php
//UNAPPROVING
if(isset($_GET['change_to_subscriber'])){
    
    $get_user_id=$_GET['change_to_subscriber'];
    
    $query=" UPDATE  users SET user_role='subscriber' WHERE user_id = {$get_user_id}";
    $unapprove_query_result=mysqli_query($connection,$query);
    confirmQuery($unapprove_query_result);
    header("Location: users.php");
}

//APPROVING
if(isset($_GET['change_to_admin'])){
    
    $get_user_id=$_GET['change_to_admin'];
    
    $query=" UPDATE  users SET user_role='admin' WHERE user_id = {$get_user_id}";
    $approve_query_result=mysqli_query($connection,$query);
    confirmQuery($approve_query_result);
    header("Location: users.php");
}


//DELETING USER
if(isset($_GET['delete'])){
    if(isset($_SESSION['user_role'])){
        
        if($_SESSION['user_role']=='admin'){
    $get_user_id=$_GET['delete'];
    
    $query=" DELETE FROM users WHERE user_id = {$get_user_id}";
    $delete_query_result=mysqli_query($connection,$query);
    confirmQuery($delete_query_result);
    header("Location: users.php");
        }
        
    }
}


?>                        
                       
                      
                     
                    