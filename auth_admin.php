<?php

if (!isset($_SESSION['email_address']) || (isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'admin')) {
	    	header('location: dashboarduser.php');
	    	exit();
} 

?>


