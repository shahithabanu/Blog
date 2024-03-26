<?php
include('connect.php');
session_start();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    unset($_SESSION['email']);
    unset($_SESSION['logged_in']);
    // unset($_SESSION['role']);
    
    session_destroy();
}


// Redirect the user to the adminindex.php page
header("Location: login.php");
exit();

?>
