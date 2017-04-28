<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  edit-request.php             							                                    
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
                
            global $e;
            
            $query = "INSERT INTO admin.blood_request(blood_request_id, b_id, name, phone, email, blood_group, hospital, delivery_confirmation, address, area, blood_amount) VALUES (admin.b_request.nextval, $branch, '$name', '$phone', '$email', '$bg', '$hname', '$dreport', '$address', '$area', '$bamount')";
            
            $query = "UPDATE admin.blood_request SET name ='$name', phone ='$phone', blood_group ='$bg', hospital ='$hname', delivery_confirmation ='$dreport', address ='$address', area ='$area', blood_amount ='$bamount' WHERE blood_request_id =".$e;

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


<?php

            global $e;
            $conn = oci_connect('system', 'admin', 'localhost/XE');
            if (!$conn) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }
            
            $query = 'SELECT * FROM admin.blood_request WHERE blood_request_id ='.$e;

            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                
        
 ?>


<div class="donor-section">
    <h1 class="menu-title">Edit Requests: </h1>
    <a href="blood-request.php" class="hlink cat-link">Back to Request List</a>
    
        <form id="add-donor-form" name="donorform" action="edit-request.php?e=<?php echo $e; ?>" method="post">
       <br>
        <p class="form-text">Name : </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php echo $row['NAME']?>">
        
        <p class="form-text">Phone : </p>
        <input name="phone" class="form-field" type="text" placeholder="Phone" value="<?php echo $row['PHONE']?>">
        
        <p class="form-text">Email : </p>
        <input name="email" class="form-field" type="text" placeholder="Email" value="<?php echo $row['EMAIL']?>">
        
        <p id="pcat" class="form-text">Select Branch : </p>
             <select name="branch">
                 <?php
                    $conc = oci_connect('system', 'admin', 'localhost/XE');

                   $sdt = oci_parse($conc, "SELECT * FROM admin.branch");
                   oci_execute($sdt);
                 
                    if($sdt) {
                        while (($bb = oci_fetch_array($sdt, OCI_BOTH)) != false) {
                            if($row['B_ID'] == $bb['B_ID'])
                            {
                                echo "<option selected='selected' value=\"".$bb['B_ID']."\">".$bb['B_NAME']."</option>";
                            }
                            else {
                                echo "<option value=\"".$bb['B_ID']."\">".$bb['B_NAME']."</option>";
                            }
                        }
                    } else {
                        echo "Branch Failed !";
                    }
                 ?>
            </select>
        
        <p id="pcat" class="form-text">Blood Group : </p>
             <select name="bg">
                 <?php
                    $cob = oci_connect('system', 'admin', 'localhost/XE');
                
                    $var = $row['BLOOD_GROUP'];
                   $sdtt = oci_parse($cob, "SELECT * FROM admin.blood");
                   oci_execute($sdtt);
                 
                    if($sdtt) {
                        while (($bg = oci_fetch_array($sdtt, OCI_BOTH)) != false) {
                            if($row['BLOOD_GROUP'] == $bg['BLOOD_GROUP'])
                            {
                                echo "<option selected='selected' value=\"".$bg['BLOOD_GROUP']."\">".$bg['BLOOD_GROUP']."</option>";
                            }
                            else {
                                echo "<option value=\"".$bg['BLOOD_GROUP']."\">".$bg['BLOOD_GROUP']."</option>";
                            }
                        }
                    } else {
                        echo "Branch Failed !";
                    }
                 ?>
            </select>
        
        <p class="form-text">Hospital : </p>
        <input name="hname" class="form-field" type="text" placeholder="Hospital Name" value="<?php echo $row['HOSPITAL']?>">
        
        <p class="form-text">Deliver Report : </p>
        <input name="dreport" class="form-field" type="text" placeholder="Report" value="<?php echo $row['DELIVERY_CONFIRMATION']?>">
        
        <p class="form-text">Address : </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address"><?php echo $row['ADDRESS']?></textarea>
        
        <p class="form-text">Area : </p>
        <input name="area" class="form-field" type="text" placeholder="Area" value="<?php echo $row['AREA']?>">
        
        <p class="form-text">Blood Amount : </p>
        <input name="bamount" class="form-field" type="text" placeholder="Blood Amount" value="<?php echo $row['BLOOD_AMOUNT']?>">
        
        <br>
        <input type="submit" name="submit" id="submit" value="Update Request" class="form-field">
        
    </form>
</div>

<?php 
    }
?>


<?php require_once('footer.php')?>
