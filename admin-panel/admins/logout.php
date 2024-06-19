<?php 

    session_start();
    session_unset();
    session_destroy();
    
    // header("location: http://localhost:8686/anime-main/admin-panel/admins/login-admins.php");

    // Define the ADMINURL constant
    define("ADMINURL", "http://localhost:8686/anime-php/admin-panel/");

    // Redirect to login page
    header("Location: " . ADMINURL . "admins/login-admins.php");
    exit();
?>