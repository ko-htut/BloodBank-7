<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  add-branch.php             							                                    
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
        add_new_branch();
    }

    function add_new_branch()
    {
        if(!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['area']) && !empty($_POST['sub-area']) && !empty($_POST['phone']) && !empty($_POST['email'])) 
        {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $area = $_POST['area'];
            $sub_area = $_POST['sub-area'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            
            $conn = oci_connect('system', 'admin', 'localhost/XE');
                
            $query = "INSERT INTO admin.branch(b_id, b_name, address, area, subarea, phone, email) VALUES (admin.brnch.nextval,'$name', '$address', '$area', '$sub_area', '$phone', '$email')";

               $stid = oci_parse($conn, $query);
               
                $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    echo "Successfully added New Branch !";
                    header('Location: branch.php');
                }

        }else {
            echo "<p id=\"warning\">Fill All The Information !</p>";
        }
    }
?>

<div class="donor-section">
    <h1 class="menu-title">Add New Branch : </h1>
    <a href="branch.php" class="hlink cat-link">Back to Branch List</a>
    
        <form id="add-donor-form" name="donorform" action="add-branch.php" method="post">
       <br>
        <p class="form-text">Branch Name : </p>
        <input name="name" class="form-field" type="text" placeholder="Name">
        
        <p class="form-text">Address : </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address"></textarea>
        
        <p class="form-text">Area : </p>
        <input name="area" class="form-field" type="text" placeholder="Area">
        
        <p class="form-text">Sub Area : </p>
        <input name="sub-area" class="form-field" type="text" placeholder="Sub Area">
        
        <p class="form-text">Phone : </p>
        <input name="phone" class="form-field" type="text" placeholder="Phone">
        
        <p class="form-text">Email : </p>
        <input name="email" class="form-field" type="text" placeholder="Email">
        
        <br>
        <input type="submit" name="submit" id="submit" value="Add Branch" class="form-field">
        
    </form>
    
</div>

<?php require_once('footer.php')?>
