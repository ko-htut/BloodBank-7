<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  add-request.php             							                                    
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
        add_new_request();
    }

    function add_new_request()
    {
        if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['address']) && !empty($_POST['branch']) && !empty($_POST['bg']) && !empty($_POST['hname']) && !empty($_POST['dreport']) && !empty($_POST['area']) && !empty($_POST['bamount'])) 
        {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $branch = $_POST['branch'];
            $bg = $_POST['bg'];
            $hname = $_POST['hname'];
            $dreport = $_POST['dreport'];
            $area = $_POST['area'];
            $bamount = $_POST['bamount'];
            
            $conn = oci_connect('system', 'admin', 'localhost/XE');
                
            $query = "INSERT INTO admin.blood_request(blood_request_id, b_id, name, phone, email, blood_group, hospital, delivery_confirmation, address, area, blood_amount) VALUES (admin.b_request.nextval, $branch, '$name', '$phone', '$email', '$bg', '$hname', '$dreport', '$address', '$area', '$bamount')";

               $stid = oci_parse($conn, $query);
               
                $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    echo "Successfully added New Blood Request !";
                    header('Location: blood-request.php');
                }

        }else {
            echo "<p id=\"warning\">Fill All The Information !</p>";
        }
    }
?>

<div class="donor-section">
    <h1 class="menu-title">Add New Requests: </h1>
    <a href="blood-request.php" class="hlink cat-link">Back to Request List</a>
    
        <form id="add-donor-form" name="donorform" action="add-request.php" method="post">
       <br>
        <p class="form-text">Name : </p>
        <input name="name" class="form-field" type="text" placeholder="Name">
        
        <p class="form-text">Phone : </p>
        <input name="phone" class="form-field" type="text" placeholder="Phone">
        
        <p class="form-text">Email : </p>
        <input name="email" class="form-field" type="text" placeholder="Email">
        
        <p id="pcat" class="form-text">Select Branch : </p>
             <select name="branch">
                 <?php
                    $conn = oci_connect('system', 'admin', 'localhost/XE');

                   $stid = oci_parse($conn, "SELECT * FROM admin.branch");
                   oci_execute($stid);
                 
                    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                        echo "<option value=\"".$row['B_ID']."\">".$row['B_NAME']."</option>";
                    }
                 ?>
            </select>
        
        <p id="pcat" class="form-text">Blood Group : </p>
             <select name="bg">
                 <?php
                    $conn = oci_connect('system', 'admin', 'localhost/XE');

                   $stid = oci_parse($conn, "SELECT * FROM admin.blood ORDER BY blood_group ASC");
                   oci_execute($stid);
                 
                    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                        echo "<option value=\"".$row['BLOOD_GROUP']."\">".$row['BLOOD_GROUP']."</option>";
                    }
                 ?>
            </select>
        
        <p class="form-text">Hospital : </p>
        <input name="hname" class="form-field" type="text" placeholder="Hospital Name">
        
        <p class="form-text">Deliver Report : </p>
        <input name="dreport" class="form-field" type="text" placeholder="Report">
        
        <p class="form-text">Address : </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address"></textarea>
        
        <p class="form-text">Area : </p>
        <input name="area" class="form-field" type="text" placeholder="Area">
        
        <p class="form-text">Blood Amount : </p>
        <input name="bamount" class="form-field" type="text" placeholder="Blood Amount">
        
        <br>
        <input type="submit" name="submit" id="submit" value="Add New Request" class="form-field">
        
    </form>
</div>

<?php require_once('footer.php')?>
