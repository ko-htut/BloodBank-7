<!--
//////////////////////////////////////////////////////////////////////////////////////////
//										                                            	
// Project:	 BLOOD_BANK - Management System                                          	                            
//		                                                                                
// File:  edit-employee.php             							                                    
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
        add_new_employee();
    }

    function add_new_employee()
    {
        if(!empty($_POST['name']) && !empty($_POST['salary']) && !empty($_POST['area']) && !empty($_POST['address'])   && !empty($_POST['branch']) && !empty($_POST['role']) && !empty($_POST['phone']) && !empty($_POST['email'])) 
        {
            $name = $_POST['name'];
            $salary = $_POST['salary'];
            $area = $_POST['area'];
            $address = $_POST['address'];
            $branch = $_POST['branch'];
            $role = $_POST['role'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            

            
            $conn = oci_connect('system', 'admin', 'localhost/XE');
                
            global $e; 
            $query = "UPDATE admin.employee SET b_id ='$branch', emp_name ='$name', emp_salary ='$salary', emp_address ='$address', emp_area ='$area', emp_role ='$role', phone ='$phone', email ='$email' WHERE emp_id =".$e;

               $stid = oci_parse($conn, $query);
               
                $result = oci_execute($stid);
                
                if(!$result) {
                    echo "Failed !";
                }else {
                    echo "Successfully added New Employee !";
                    header('Location: employee.php');
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
            
            $query = 'SELECT * FROM admin.employee WHERE emp_id ='.$e;

            $stid = oci_parse($conn, $query);
            oci_execute($stid);
            
            while (($row = oci_fetch_array($stid, OCI_BOTH)) != false) {
                
        
 ?>

<div class="donor-section">
    <h1 class="menu-title">Edit Employee: </h1>
    <a href="employee.php" class="hlink cat-link">Back to Employee List</a>
    
        <form id="add-donor-form" name="donorform" action="edit-employee.php?e=<?php echo $e;?>" method="post">
       <br>
        <p class="form-text">Employee Name : </p>
        <input name="name" class="form-field" type="text" placeholder="Name" value="<?php echo $row['EMP_NAME']?>">
        
        <p class="form-text">Salary : </p>
        <input name="salary" class="form-field" type="text" placeholder="Salary" value="<?php echo $row['EMP_SALARY']?>">
        
        <p class="form-text">Area : </p>
        <input name="area" class="form-field" type="text" placeholder="Area" value="<?php echo $row['EMP_AREA']?>">
        
        <p class="form-text">Address : </p>
        <textarea name="address" id="textarea" class="form-field" cols="30" rows="10" placeholder="Address" ><?php echo $row['EMP_ADDRESS']?></textarea>
        
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
        
        <p class="form-text">Role : </p>
        <input name="role" class="form-field" type="text" placeholder="Role" value="<?php echo $row['EMP_ROLE']?>">
        
        <p class="form-text">Phone : </p>
        <input name="phone" class="form-field" type="text" placeholder="Phone" value="<?php echo $row['PHONE']?>">
        
        <p class="form-text">Email : </p>
        <input name="email" class="form-field" type="text" placeholder="Email" value="<?php echo $row['EMAIL']?>">
        
        <br>
        <input type="submit" name="submit" id="submit" value="Update Employee" class="form-field">
        
    </form>
</div>

<?php 
    }
?>

<?php require_once('footer.php')?>
