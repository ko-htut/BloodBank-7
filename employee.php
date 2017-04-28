<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  employee.php             							                                    
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
        
        $query = 'DELETE FROM admin.employee WHERE emp_id='.$p;

        $stid = oci_parse($conn, $query);
        oci_execute($stid);
        
        header('Location: employee.php');
        
    }
?>

<div class="donor-section">
    <h1 class="menu-title">Employee: </h1>
    <a href="add-employee.php" class="hlink cat-link">Add New Employee</a>
    
    
    
    <?php

        $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.employee');
        oci_execute($stid);
    
    
    
        echo '<table class="tbls">
            <tr>
            <td>Name</td>
            <td>Salary</td>
            <td>Address</td>
            <td>Area</td>
            <td>Branch</td>
            <td>Role</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Delete</td>
            <td>Edit</td>
            </tr>';

        while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
            
                   //Branch
            $con = oci_connect('system', 'admin', 'localhost/XE');
            if (!$con) {
                $e = oci_error();
                trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }

            $std = oci_parse($con, 'SELECT b_name FROM admin.branch WHERE b_id ='.$row['B_ID']);
            oci_execute($std);
            
            while (($branch = oci_fetch_array($std, OCI_BOTH)) != false) {
            
            echo '<tr>
            <td>'.$row["EMP_NAME"].'</td>
            <td>'.$row["EMP_SALARY"].'</td>
            <td>'.$row["EMP_ADDRESS"].'</td>
            <td>'.$row["EMP_AREA"].'</td>
            <td>'.$branch["B_NAME"].'</td>
            <td>'.$row["EMP_ROLE"].'</td>
            <td>'.$row["PHONE"].'</td>
            <td>'.$row["EMAIL"].'</td>
            <td> <a id="edit" href="edit-employee.php?e='.$row['EMP_ID'].'">Edit</a></td>
            <td> <a id="delete" onclick="return confirm(\'You Want To Delete This Item ?\');" href="employee.php?p='.$row['EMP_ID'].'">Delete</a></td>
            </tr>';
                
            }

        }
            
     echo '</table>';


    ?>

    
</div>

<?php require_once('footer.php')?>
