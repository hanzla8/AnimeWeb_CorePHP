<?php require "../../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?> 

<?php

    if (isset($_GET['id'])) 
    {
        $id = $_GET['id'];

        $image = $conn->query("SELECT * FROM shows WHERE id='$id'");
        $image->execute();

        $getimage = $image->fetch(PDO::FETCH_OBJ);

        unlink("img/" . $getimage->image);

        $deleteShow = $conn->query("DELETE FROM shows WHERE id='$id'");
        $deleteShow->execute();

        header("location: show-shows.php");
    }





?>