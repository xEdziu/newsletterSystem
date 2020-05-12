<?php 
	
	session_start();

    require_once('config.php');
    
    ob_start();

        if ( $_SERVER["REQUEST_METHOD"] == "POST"){

        	$login = $link->real_escape_string($_POST["login"]);
        	$password = $link->real_escape_string($_POST["password"]);

        	$check = $link->query("SELECT * FROM admin_users WHERE login='$login'");
        	$checkNum = $check->num_rows;

        	if($checkNum != 1){

        		echo "Incorrect data";
            	header("Location: http://yourpage.com/admin/login_admin.html");

        	} else {

        		$checkPass = $link->query("SELECT password FROM admin_users WHERE login='$login'");

	        	
        		if ($checkPass->num_rows>0) {

        			$pswd = $checkPass->fetch_assoc();
        			
        			if ($pswd['password'] === $password){

        				$_SESSION['admin'] = 1;
						header("Location: http://yourpage.com/admin/logs_newsletter.php");

        			} else {

        				header("Location: http://yourpage.com/admin/login_admin.html");

        			}
        		}
				
	        	ob_end_clean();

	        }
        	
        } else {

        	echo "NO DATA";

        }
?>