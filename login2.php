<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  login2.php             							                                    
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
            echo '<p id="failed">Login Failed !</p>';
        }

        
    }else {
        echo '<p id="failed">Fill All The Information</p>';
    }
}

?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]>-->
<!--[if !IE]> <!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Login</title>
	
	<style>
            body {
            background: url('images/1.jpg') no-repeat fixed center center;
            background-size: cover;
            font-family: Montserrat;
        }

        .logo {
            width: 213px;
            height: 36px;
            margin: 50px auto;
        }

        .login-block {
            width: 320px;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            border-top: 5px solid #ff656c;
            margin: 0 auto;
        }

        .login-block h1 {
            text-align: center;
            color: #000;
            font-size: 18px;
            text-transform: uppercase;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .login-block input {
            width: 100%;
            height: 42px;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 14px;
            font-family: Montserrat;
            padding: 0 20px 0 50px;
            outline: none;
        }

        .login-block input#username {
            background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px top no-repeat;
            background-size: 16px 80px;
        }

        .login-block input#username:focus {
            background: #fff url('http://i.imgur.com/u0XmBmv.png') 20px bottom no-repeat;
            background-size: 16px 80px;
        }

        .login-block input#password {
            background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px top no-repeat;
            background-size: 16px 80px;
        }

        .login-block input#password:focus {
            background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
            background-size: 16px 80px;
        }

        .login-block input:active, .login-block input:focus {
            border: 1px solid #ff656c;
        }

        #login_submit {
            width: 100%;
            height: 40px;
            background: #ff656c;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #e15960;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            font-family: Montserrat;
            outline: none;
            cursor: pointer;
            padding-right: 45px;
        }

        #login_submit:hover {
            background: #ff7b81;
        }

    </style>

</head>

<body>

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <div class="logo"></div>
        <div class="login-block">
           <form action="login2.php" method="post" name="loginform" id="loginform" >
                <h1>Blood Bank <br> Management System</h1>
                <input name="username" type="text" value="" placeholder="Username" id="username" />
                <input name="password" type="password" value="" placeholder="Password" id="password" />
                <input id="login_submit" type="submit" name="submit" value="Login">
            </form>
        </div>

</body> 

</html>

