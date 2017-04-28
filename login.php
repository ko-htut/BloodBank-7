<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  login.php             							                                    
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
<?php require_once('header.php'); ?>

<?php

    if(!empty($_SESSION['user']))
    {
        header('Location: home.php');
    }

    if(isset($_POST['submit']))
    {
        login();
    }

function login()
{
    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $conn = oci_connect('system', 'admin', 'localhost/XE');

       $stid = oci_parse($conn, "SELECT * FROM admin.user_info WHERE username='$username' AND password='$password'");
       oci_execute($stid);
        
        $row = oci_fetch_array($stid, OCI_BOTH); 
        if($username === $row['USERNAME'] && $password === $row['PASSWORD']) {
            $_SESSION['user'] = $username;
            header('Location: home.php');
        }
        else {
            echo "Login Failed !";
        }

        
    }else {
        echo "Fill All The Information !";
    }
}

?>



<section>
    <div class="loginwrapper">
        <img src="images/test/blood-bank.png" alt="">
        
        <form action="login.php" method="post" name="loginform" id="loginform" >
            <p id="username">Username</p>
            <input name="username" type="text" placeholder="Username">
            <br>
            <br>
            <p id="password">Password </p>
            <input name="password" type="password" placeholder="password">
            <br>
            <br>
            <input id="login_submit" type="submit" name="submit" value="Login">
            
        </form>
    </div>
</section>