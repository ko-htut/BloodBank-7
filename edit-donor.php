<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  edit-donor.php             							                                    
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
        edit_donor();
    }

    function edit_donor()
    {
        if(!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['area']) && !empty($_POST['sub-area']) && !empty($_POST['branch']) && !empty($_POST['bg']) && !empty($_POST['nid']) && !empty($_POST['phone']) && !empty($_POST['email'])) 
        {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $area = $_POST['area'];
            $sub_area = $_POST['sub-area'];
            $branch = $_POST['branch'];
            $bg = $_POST['bg'];
            $nid = $_POST['nid'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            
            $conn = oci_connect('system', 'admin', 'localhost/XE');
            
            global $e;
            $query = "UPDATE admin.donor SET b_id ='$branch', d_name ='$name', address ='$address', area='$area', subarea ='$sub_area', national_id ='$nid', blood_group ='$bg', phone ='$phone', email ='$email' WHERE d_id =".$e;

               $stid = oci_parse($conn, $query);
    
                $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    echo "Donor Updated!";
                    
                    header('Location: donor.php');
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
            
            $query = 'SELECT * FROM admin.donor WHERE d_id ='.$e;

            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                
        
 ?>


<div class="donor-section">
    <h1 class="menu-title">Update Donor : </h1>
    <a href="donor.php" class="hlink cat-link">Back to Donor List</a>
    
    <form id="add-donor-form" name="donorform" action="edit-donor.php?e=<?php echo $e;?>" method="post">
       <br>
        <p class="form-text">Donor Name : </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php echo $row['D_NAME']?>">
        
        <p class="form-text">Address : </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address"><?php echo $row['ADDRESS']?></textarea>
        
        <p class="form-text">Area : </p>
        <input name="area" class="form-field" type="text" placeholder="Area" value="<?php echo $row['AREA']?>">
        
        <p class="form-text">Sub Area : </p>
        <input name="sub-area" class="form-field" type="text" placeholder="Sub Area" value="<?php echo $row['SUBAREA']?>">
        
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
            
            
        
        <p class="form-text">National ID : </p>
        <input name="nid" class="form-field" type="text" placeholder="National id" value="<?php echo $row['NATIONAL_ID']?>">
        
        <p class="form-text">Phone : </p>
        <input name="phone" class="form-field" type="text" placeholder="Phone" value="<?php echo $row['PHONE']?>">
        
        <p class="form-text">Email : </p>
        <input name="email" class="form-field" type="text" placeholder="Email" value="<?php echo $row['EMAIL']?>">
        
        <br>
        <input type="submit" name="submit" id="submit" value="Update Donor" class="form-field">
        
    </form>
</div>

<?php 
    }
?>


<?php require_once('footer.php')?>
