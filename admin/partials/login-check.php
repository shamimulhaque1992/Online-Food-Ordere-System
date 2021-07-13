<?php
	if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login-message']="<div class ='error text-center'>Please Login First To Get Access In Admin Panel...</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
	
	
	
?>