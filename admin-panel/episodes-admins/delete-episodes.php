<?php require "../../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?> 

<?php

    if (isset($_GET['id'])) 
    {
        $id = $_GET['id'];

        $thumbnail = $conn->query("SELECT * FROM episodes WHERE id='$id'");
        $thumbnail->execute();

        $getThumbnail = $thumbnail->fetch(PDO::FETCH_OBJ);

        unlink("videos/" . $getThumbnail->thumbnail);

        // with vedio delete too
        $video = $conn->query("SELECT * FROM episodes WHERE id='$id'");
        $video->execute();

        $getVideo = $video->fetch(PDO::FETCH_OBJ);

        unlink("videos/" . $getVideo->video);

        $deleteEpisodes = $conn->query("DELETE FROM episodes WHERE id='$id'");
        $deleteEpisodes->execute();

        header("location: show-episodes.php");
    }





?>