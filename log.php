<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  log.php             							                                    
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
        
        $query = 'DELETE FROM admin.user_triger WHERE ut_id='.$p;

        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        
        header('Location: log.php');
        
    }
?>

<div class="donor-section">
    <h1 class="menu-title">LOG REPORT : (USER)</h1>
    
    <?php

        $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.user_triger');
        oci_execute($stid);

    
        echo '<table class="tbls">
            <tr>
            <td>Action</td>
            <td>Time</td>
            <td>Old Username</td>
            <td>New Username</td>
            <td>Delete</td>
            </tr>';

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            
            echo '<tr>
            <td>'.$row["ACTION"].'</td>
            <td>'.$row["TIME"].'</td>
            <td>'.$row["OLD"].'</td>
            <td>'.$row["NEW"].'</td>
            <td> <a id="delete" onclick="return confirm(\'You Want To Delete This Item ?\');"" href="log.php?p='.$row['UT_ID'].'">Delete</a></td>
            </tr>';
        }
     echo '</table>';


    ?>
</div>


<?php require_once('footer.php')?>
