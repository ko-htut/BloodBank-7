<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  sidebar.php             							                                    
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






<div class="head-section">
    <h1 id="heading">Blood Bank Management System</h1>
</div>

<div id="mini-section" class="clearfix">
    <ul class="header-list">
        <li><a href="">
            <?php
                //Procedure

                $conn = oci_connect('system', 'admin', 'localhost/XE');

                $sql = 'BEGIN admin.sayHello(:name, :message); END;';

                $stmt = oci_parse($conn,$sql);

                //  Bind the input parameter
                oci_bind_by_name($stmt,':name',$name,32);

                // Bind the output parameter
                oci_bind_by_name($stmt,':message',$message,32);

                // Assign a value to the input 
                $name = $_SESSION['user'];

                oci_execute($stmt);

                // $message is now populated with the output value
                print "$message\n";

            ?>
            </a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="sidebar">
    <ul class="main-nav">  
        <a href="home.php">
            <li>
                <img src="images/dashboard.png" alt="">
                <p>Dashboard</p>
            </li>
        </a>
        <a href="donor.php">
            <li>
                <img src="images/blood_in_hand.png" alt="">
                <p>Donor</p>
            </li>
        </a>
        <a href="branch.php">
            <li>
                <img src="images/branch.png" alt="">
                <p>Branch</p>
            </li>
        </a>
        <a href="blood.php">
            <li>
                <img src="images/heart-beat.png" alt="">
                <p>Blood</p>
            </li>
        </a>
        <a href="blood-request.php">
            <li>
                <img src="images/blood-request.png" alt="">
                <p>Blood Request</p>
            </li>
        </a>
        <a href="employee.php">
            <li>
                <img src="images/group.png" alt="">
                <p>Employees</p>
            </li>
        </a>
        <a href="user.php">
            <li>
                <img src="images/user.png" alt="">
                <p>Users</p>
            </li>
        </a>
        <a href="logout.php">
            <li>
                <img src="images/logout.png" alt="">
                <p>Logout</p>
            </li>
        </a>
        
    </ul>
</div>