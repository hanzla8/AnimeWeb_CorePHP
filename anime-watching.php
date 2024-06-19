<?php include "config/config.php" ?>
<?php include "includes/header.php" ?>

<?php

if(isset($_GET['id']) && isset($_GET['ep'])) {
    $id = $_GET['id'];
    $ep = $_GET['ep'];

    // Fetch all episodes
    $episodes = $conn->query("SELECT * FROM episodes WHERE show_id='$id'");
    $episodes->execute();
    $allepisodes = $episodes->fetchAll(PDO::FETCH_OBJ);

    // Fetch the specific episode
    $episode = $conn->query("SELECT * FROM episodes WHERE show_id='$id' AND name='$ep'");
    $episode->execute();
    $singleEpisode = $episode->fetch(PDO::FETCH_OBJ);

    // Fetch show data
    $show = $conn->query("SELECT * FROM shows WHERE id='$id'");
    $show->execute();
    $singleShow = $show->fetch(PDO::FETCH_OBJ);

    // Fetch comments
    $comments = $conn->query("SELECT * FROM comments WHERE show_id='$id'");
    $comments->execute();
    $allcomments = $comments->fetchAll(PDO::FETCH_OBJ);

    // Inserting Comment
    if(isset($_POST['inserting_comment'])) {
        if(empty($_POST['comment'])) {
            echo "<script>alert('Comment is empty');</script>";
        } else {
            $comment = $_POST['comment'];
            $show_id = $_POST['show_id'];
            $user_id = $_SESSION['user_id'];
            $user_name = $_SESSION['username'];

            $insert = $conn->prepare("INSERT INTO comments (comment, show_id, user_id, user_name) 
                                      VALUES (:comment, :show_id, :user_id, :user_name)");
            $insert->execute([
                ":comment" => $comment,
                ":show_id" => $show_id,
                ":user_id" => $user_id,
                ":user_name" => $user_name,
            ]);
            echo "<script>alert('Your Comment inserted');</script>";
        }
    }
} else {
    echo ("<script>location.href='".APPURL."/404.php'</script>");
}

?>



<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="<?php echo APPURL; ?>"><i class="fa fa-home"></i> Home</a>
                    <a href="<?php echo APPURL; ?>/categories.php?name=<?php echo $singleShow->genre; ?>">Categories</a>
                    <a href="#">
                        <?php echo $singleShow->genre; ?>
                    </a>
                    <span>
                        <?php echo $singleShow->title; ?>
                    </span>
                    <span> EP
                        <?php echo $singleEpisode->name; ?>
                    </span>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Anime Section Begin -->
<section class="anime-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="anime__video__player">
                    <video id="player" playsinline controls
                        data-poster="<?php echo VIDEOSURL ;?>/<?php echo $singleEpisode->thumbnail ; ?>">
                        <source src="<?php echo VIDEOSURL ;?>/<?php echo $singleEpisode->video ; ?>"
                            type="video/mp4" />
                        <!-- Captions are optional -->
                        <!-- <track kind="captions" label="English captions" src="#" srclang="en" default /> -->
                    </video>
                </div>
                <div class="anime__details__episodes">
                    <div class="section-title">
                        <h5>List Name</h5>
                    </div>
                    <?php if(!empty($allepisodes)) : ?>
                    <?php foreach($allepisodes as $episode) :?>
                    <a
                        href="<?php echo APPURL; ?>/anime-watching.php?id=<?php echo $episode->show_id; ?>&ep=<?php echo $episode->name; ?>">EP
                        <?php echo $episode->id; ?>
                    </a>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <p>No episodes found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="anime__details__review">
                    <div class="section-title">
                        <h5>Comments</h5>
                    </div>
                    <?php foreach($allcomments as $comments) : ?>
                    <div class="anime__review__item">
                        <!-- <div class="anime__review__item__pic">
                                    <img src="img/anime/review-1.jpg" alt="">
                                </div> -->
                        <div class="anime__review__item__text">
                            <h6>
                                <?php echo $comments->user_name; ?> - <span>
                                    <?php echo $comments->user_name; ?>
                                </span>
                            </h6>
                            <p>
                                <?php echo $comments->comment; ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
                <div class="anime__details__form">
                    <div class="section-title">
                        <h5>Your Comment</h5>
                    </div>
                    <form method="POST"
                        action="<?php echo APPURL; ?>/anime-watching.php?id=<?php echo $id; ?> &ep=<?php echo $ep ;?>">
                        <textarea class="text-dark" placeholder="Your Comment" name="comment"></textarea>
                        <input type="hidden" name="show_id" value="<?php echo $id; ?>">
                        <button type="submit" name="inserting_comment"><i class="fa fa-location-arrow"></i>
                            Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Anime Section End -->



<?php include "includes/footer.php" ?>