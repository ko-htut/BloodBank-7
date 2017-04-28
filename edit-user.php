<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  edit-user.php             							                                    
//											                                            
// Version: 1.0										                                    
//										                                            	
// Description:                                                                        	
//											                                            
//		      A Simple Blood Bank Mangement System made in Raw PHP                               							                
//											                                            
//											                                            
//											                                            
//											                                            
// Author: Ami Bappy [amibappy77@gmail.com]						                        
//                                                                                      
// Github: https://github.com/amibappy                                                 
//                                                                                     
//        										                                        
//  .______       .___      .______   .______   ____.  .____ 				          
//  |   _  \      /   \     |   _  \  |   _  \  \   \  /   / 				            
//  |  |_)  |    /  ^  \    |  |_)  | |  |_)  |  \   \/   /  				            
//  |   _  <    /  /_\  \   |   ___/  |   ___/    \_    _/   				            
//  |  |_)  |  /  _____  \  |  |      |  |          |  |     				           
//  |______/  /__/     \__\ | _|      | _|          |__|     				           
//                                                       				               
//											                                            
//											                                            
//////////////////////////////////////////////////////////////////////////////////////////
//											                                            
// Copyright (c) 2017 Bappy [amibappy77@gmail.com]					                    
// All Rights Reserved.									                                
//											                                            
//////////////////////////////////////////////////////////////////////////////////////////
//											                                            
// Unauthorized copying of this file, via any medium is strictly prohibited	            
// Proprietary and confidential								                            
//											                                           
//////////////////////////////////////////////////////////////////////////////////////////
//											                                           
// DO NOT REMOVE THIS AREA                                                              
//                                                                                      
////////////////////////////////////////////////////////////////////////////////////////// 
-->





<?php session_start(); ?>
<?php require_once('header.php')?>
<?php require_once('sidebar.php')?>
<?php
    if(!$_SESSION['user'])
    {
        header('Location: login.php');
    }

    global $e;

    if(isset($_REQUEST['e']))
    {
        $e = $_GET['e'];
    }

    if(isset($_POST['submit']))
    {
        update_user();
    }

    function update_user()
    {
        if(!empty($_POST['name']) && !empty($_POST['password'])) 
        {
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $conn = oci_connect('system', 'admin', 'localhost/XE');
                
            global $e;
            $query = "UPDATE admin.user_info SET username ='$name', password ='$password' WHERE user_id =".$e;

               $stid = oci_parse($conn, $query);
               
                $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    echo "Successfully added New User !";
                    header('Location: user.php');
                }

        }else {
            echo "<p id=\"warning\">Fill All The Information !</p>";
        }
    }
?>


<?php
            global $e;
            $conn = oci_connect('system', 'admin', 'localhost/XE');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }
            
            $query = 'SELECT * FROM admin.user_info WHERE user_id ='.$e;

            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                
        
 ?>

<div class="donor-section">
    <h1 class="menu-title">Edit User : </h1>
    <a href="user.php" class="hlink cat-link">Back to User List</a>
    
    <form id="add-donor-form" name="donorform" action="edit-user.php?e=<?php echo $e; ?>" method="post">
       <br>
        <p class="form-text">User Name : </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php echo $row['USERNAME']?>">
        
        <p class="form-text">Password : </p>
        <input name="password" class="form-field" type="password" placeholder="Password" value="<?php echo $row['PASSWORD']?>">
        
        
        <br>
        <input type="submit" name="submit" id="submit" value="Update User" class="form-field">
        
    </form>
</div>

<?php 
    }
?>

<?php require_once('footer.php')?>
