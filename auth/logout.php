<?php 

    session_start();
    session_unset();
    session_destroy();
    
    header("location: http://localhost:8686/anime-php/");
?>