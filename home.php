<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  home.php             							                                    
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



    //Donor Count

    $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.donor');
        oci_execute($stid);
        $donor_count = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $donor_count++;
    }

    //Blood Count

    $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.blood');
        oci_execute($stid);
        $blood_count = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $blood_count++;
    }

//Blood Request

    $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.blood_request');
        oci_execute($stid);
        $blood_req = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $blood_req++;
    }


//Branch

    $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.branch');
        oci_execute($stid);
        $branch = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $branch++;
    }

//Employee

    $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.employee');
        oci_execute($stid);
        $emp = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $emp++;
    }


    //Transection

    $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.blood');
        oci_execute($stid);
        $tk = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $tk = $tk + $row['PAID_AMOUNT'];
    }

    //User

    $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.user_info');
        oci_execute($stid);
        $user = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $user++;
    }

    //Log Report

    $conn = oci_connect('system', 'admin', 'localhost/XE');
        if (!$conn) {
            $e = oci_error();
            trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stid = oci_parse($conn, 'SELECT * FROM admin.user_triger');
        oci_execute($stid);
        $log = 0;

    while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) { 
        $log++;
    }
?>




<div id="dashboard-section">
    <ul id="dashboardlist">
        <li>
            <img src="images/group.png" alt="">
            <p>Number of Donor : <span class="dash"><?php echo $donor_count; ?></span> </p>
        </li>
        <li>
            <img src="images/blood.ico" alt="">
            <p>Blood in Stock : <span class="dash"><?php echo $blood_count; ?></span></p>
        </li>
        <li>
            <img src="images/time.png" alt="">
            <p>Blood Request : <span class="dash"><?php echo $blood_req; ?></span></p>
        </li>
        <li>
            <img src="images/branch2.png" alt="">
            <p>Total Branch : <span class="dash"><?php echo $branch; ?></span></p>
        </li>
        <li>
            <img src="images/emp.png" alt="">
            <p>Total Employee : <span class="dash"><?php echo $emp; ?></span></p>
        </li>
        <li>
            <img src="images/dollar.png" alt="">
            <p>Transaction : <span class="dash">$ <?php echo $tk; ?></span></p>
        </li>
        <li>
            <img src="images/user.png" alt="">
            <p>Users : <span class="dash"><?php echo $user; ?></span></p>
        </li>
        <li>
            <img src="images/log.png" alt="">
            <p>Log Report : <span class="dash"><?php echo $log; ?></span></p>
        </li>
        
    </ul>
    
    <div class="dashboard-links">
            <a href="add-donor.php" class="hlink">Add a Donor</a>
            <a style="margin-left: 100px;" href="add-request.php" class="hlink">Add Blood Request</a>
            <a href="add-branch.php" class="hlink">Add New Branch</a>
            <a style="margin-left: 61px;" href="add-employee.php" class="hlink">Add a Employee</a>
            <a href="add-user.php" class="hlink">Add New User</a>
            <a style="margin-left: 85px;" href="log.php" class="hlink">User Log Report</a>
            
    </div>
            
</div>

<?php require_once('footer.php')?>
