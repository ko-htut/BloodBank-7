<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  add-user.php             							                                    
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

    if(isset($_POST['submit']))
    {
        add_new_user();
    }

    function add_new_user()
    {
        if(!empty($_POST['name']) && !empty($_POST['password'])) 
        {
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $conn = oci_connect('system', 'admin', 'localhost/XE');
                
            $query = "INSERT INTO admin.user_info(user_id,username,password) VALUES (admin.nuser.nextval, '$name', '$password')";

               $stid = oci_parse($conn, $query);
               
                $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    echo "Successfully added New User !";
                    header('Location: User.php');
                }

        }else {
            echo "<p id=\"warning\">Fill All The Information !</p>";
        }
    }
?>

<div class="donor-section">
    <h1 class="menu-title">Add New User : </h1>
    <a href="user.php" class="hlink cat-link">Back to User List</a>
    
    <form id="add-donor-form" name="donorform" action="add-user.php" method="post">
       <br>
        <p class="form-text">User Name : </p>
        <input name="name" class="form-field" type="text" placeholder="Name">
        
        <p class="form-text">Password : </p>
        <input name="password" class="form-field" type="password" placeholder="Password">
        
        
        <br>
        <input type="submit" name="submit" id="submit" value="Add New User" class="form-field">
        
    </form>
</div>


<?php require_once('footer.php')?>
