<?php

if (!isset($_SESSION['email_address'])) {
    header('location: login.php');
    exit();
    } 

?>