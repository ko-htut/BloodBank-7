<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  blood.php             							                                    
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

    if(isset($_GET['p']))
    {
        $p = $_GET['p'];
        
        $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        
        $query = 'DELETE FROM admin.blood WHERE blood_id='.$p;

        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        
        header('Location: blood.php');
        
    }
?>

<div class="donor-section">
    <h1 class="menu-title">Blood : </h1>
    
    <?php

        $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.blood ORDER BY blood_group ASC');
        oci_execute($stid);
    
    
    
        echo '<table class="tbls">
            <tr>
            <td>Blood Group</td>
            <td>Blood Amount</td>
            <td>Paid Amount</td>
            <td>Edit</td>
            </tr>';

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            
            echo '<tr>
            <td>'.$row["BLOOD_GROUP"].'</td>
            <td>'.$row["BLOOD_AMOUNT"].'</td>
            <td>'.$row["PAID_AMOUNT"].'</td>
            <td> <a id="edit" href="edit-blood.php?e='.$row['BLOOD_ID'].'">Edit</a></td>
            </tr>';
        }
     echo '</table>';


    ?>
    
</div>

<?php require_once('footer.php')?>
