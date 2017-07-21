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
                        
                        <div class="col-xs-6">
                           <?php add_categories();?>
                          
                            <form action="" method="post">
                                <div class="form-group">
                                   <label for="cat_title">Add Category</label>
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" value="Add Category" name="submit">
                                </div>
                                
                            </form>
                            
                            <?php //EDIT AND INCLUDE 
                            if(isset($_GET['edit'])){
                                $cat_id=$_GET['edit'];
                                
                                include "includes/update_category.php";
                            }
                            
                            ?>                     
                        </div><!--Add category-->
                        
                        <div class="col-xs-6">
                           

<?php


?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                
                                
                                <tbody>
                                   
                                   
<?php  //FIND ALL CATEGORY
addAllCategories();
?>
                          
<?php //DELETE CATEGORY
deleteCategories()
?>                 
                           
                                    <!--<tr>
                                        <td><?php echo "<td>$cat_id</td>";?> </td>
                                        <td><?php echo "<td>$cat_title</td>";?> </td>
                                    </tr>
                                   -->
                                </tbody>
                                
                            </table>
                            
                            
                        </div>
                       
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

 <?php include"includes/admin_footer.php";?>