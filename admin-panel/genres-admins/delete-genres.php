<?php require "../../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?> 

<?php

    if (isset($_GET['id'])) 
    {
        $id = $_GET['id'];

        $deleteShow = $conn->query("DELETE FROM genre WHERE id='$id'");
        $deleteShow->execute();

        header("location: show-genres.php");
    }





?>