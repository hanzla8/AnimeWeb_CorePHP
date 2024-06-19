<?php include "config/config.php" ?>
<?php include "includes/header.php" ?>

<?php 

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $Shows = $conn->prepare("
            SELECT shows.id AS id, shows.image AS image, shows.number_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type, shows.description AS description, shows.duration AS duration, shows.date_aired AS date_aired, shows.quality AS quality, shows.status AS status, shows.studios AS studios, shows.created_at AS created_at, 
            COUNT(views.show_id) AS count_views 
            FROM shows 
            JOIN views ON shows.id = views.show_id 
            WHERE shows.id = :id 
            GROUP BY shows.id
        ");

        $Shows->bindParam(':id', $id, PDO::PARAM_INT);
        $Shows->execute();

        // Fetch single show
        $singleShow = $Shows->fetch(PDO::FETCH_OBJ);

        // it is our changes
        if ($singleShow) {
            // Fetch the first available episode
            $firstEpisode = $conn->prepare("SELECT name FROM episodes WHERE show_id = :id ORDER BY name ASC LIMIT 1");
            $firstEpisode->bindParam(':id', $id, PDO::PARAM_INT);
            $firstEpisode->execute();
            $firstAvailableEpisode = $firstEpisode->fetch(PDO::FETCH_OBJ);
    
            if ($firstAvailableEpisode) {
                $firstEpisodeName = $firstAvailableEpisode->name;
            } else {
                $firstEpisodeName = "1"; // Default fallback if no episodes are found
            }
        } else {
            echo "Show not found.";
        }

        // you might like ...
        $foryouShows = $conn->query("
            SELECT 
                shows.id AS id, 
                shows.image AS image, 
                shows.number_available AS num_available, 
                shows.num_total AS num_total, 
                shows.title AS title, 
                shows.genre AS genre, 
                shows.type AS type, 
                COUNT(views.show_id) AS count_views 
            FROM shows 
            JOIN views ON shows.id = views.show_id 
            GROUP BY shows.id 
            ORDER BY views.show_id ASC
        ");
        $foryouShows->execute();
        $allforyouShows = $foryouShows->fetchAll(PDO::FETCH_OBJ);

        // Comment
        $comments = $conn->query("SELECT * FROM comments WHERE show_id='$id'");
        $comments->execute();

        $allcomments = $comments->fetchAll(PDO::FETCH_OBJ);

        // following
        if(isset($_POST['submit'])){

            $show_id = $_POST['show_id'];
            $user_id = $_POST['user_id'];

            $follow = $conn->prepare("INSERT INTO followings (show_id, user_id) VALUES (:show_id, :user_id)");

            $follow->execute([
                ":show_id" => $show_id,
                ":user_id" => $user_id,

            ]);
            echo "<script> alert('You followed this show') </script>";


            // cheaking if user followd 
            $cheakfollowing = $conn->query("SELECT * FROM followings WHERE show_id='$id' AND user_id='$_SESSION[user_id]'");
            $cheakfollowing->execute();

        }

        
// Inserting Comment

    if(isset($_POST['inserting_comment'])){
    if(empty($_POST['comment'])){
        echo "<script> alert('Comment is empty') </script>";
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
            echo "<script> alert('Your Comment inserted') </script>";

        }
    }


    // Checking if the user has viewed this page or not
    $checkView = $conn->prepare("SELECT * FROM views WHERE show_id = :show_id AND user_id = :user_id");
    $checkView->execute([
        ":show_id" => $id,
        ":user_id" => $_SESSION['user_id']
    ]);

    if ($checkView->rowCount() == 0) {
        try {
            $insertView = $conn->prepare("INSERT INTO views (show_id, user_id) VALUES (:show_id, :user_id)");
            $insertView->execute([
                ":show_id" => $id,
                ":user_id" => $_SESSION['user_id']
            ]);
        } catch (PDOException $e) {
            // Handle the error
            echo "Error: " . $e->getMessage();
        }
    }


    } 
    else
    {
        echo ("<script>location.href='".APPURL."/404.php'</script>");
    }


?>



<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <a href="<?php echo APPURL; ?>/anime-details.php?id=<?php echo $singleShow->id; ?>">Details</a>
                    <span>
                        <?php echo $singleShow->title; ?>
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
        <div class="anime__details__content">
            <div class="row">
                <!--  -->

                <?php if (isset($singleShow)): ?>
                <div class="col-lg-3">
                    <div class="anime__details__pic set-bg" data-setbg="<?php echo IMAGEURL ;?>/<?php echo $singleShow->image; ?>">
                        <div class="view"><i class="fa fa-eye"></i>
                            <?php echo $singleShow->count_views; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3>
                                <?php echo $singleShow->title; ?>
                            </h3>
                        </div>
                        <p>
                            <?php echo $singleShow->description; ?>
                        </p>
                        <div class="anime__details__widget">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Type:</span>
                                            <?php echo $singleShow->type; ?>
                                        </li>
                                        <li><span>Studios:</span>
                                            <?php echo $singleShow->studios; ?>
                                        </li>
                                        <li><span>Date aired:</span>
                                            <?php echo $singleShow->created_at; ?>
                                        </li>
                                        <li><span>Status:</span>
                                            <?php echo $singleShow->status; ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <ul>
                                        <li><span>Genre:</span>
                                            <?php echo $singleShow->genre; ?>
                                        </li>
                                        <li><span>Duration:</span>
                                            <?php echo $singleShow->duration; ?>
                                        </li>
                                        <li><span>Quality:</span>
                                            <?php echo $singleShow->quality; ?>
                                        </li>
                                        <li><span>Views:</span>
                                            <?php echo $singleShow->count_views; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="anime__details__btn">

                        <form method="POST" action="anime-details.php?id=<?php echo $id; ?>">
                            <input type="hidden" value="<?php echo $id;?>" name="show_id">
                            <input type="hidden" value="<?php echo $_SESSION['user_id'];?>" name="user_id">
                            <?php if (isset($cheakfollowing) && $cheakfollowing->rowCount() > 0) : ?>
                            <button name="submit" type="submit" class="follow-btn" disabled>
                                <i class="fa fa-heart-o"></i> Followed
                            </button>
                            <?php else : ?>
                            <button name="submit" type="submit" class="follow-btn">
                                <i class="fa fa-heart-o"></i> Follow
                            </button>
                            <?php endif; ?>
                            <a href="anime-watching.php?id=<?php echo $id; ?>&ep=<?php echo $firstEpisodeName; ?>" class="watch-btn">
                                <span>Watch Now</span> <i class="fa fa-angle-right"></i>
                            </a>
                        </form>


                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!--  -->
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Comments</h5>
                        </div>
                        <?php foreach($allcomments as $comment) : ?>
                        <div class="anime__review__item">
                            <div class="anime__review__item__text">
                                <h6>
                                    <?php echo $comment->user_name; ?>- <span>
                                        <?php echo $comment->created_at; ?>
                                    </span>
                                </h6>
                                <p>
                                    <?php echo $comment->comment; ?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>

                        <form method="POST" action="<?php echo APPURL; ?>/anime-details.php?id=<?php echo $id; ?>">
                            <textarea class="text-dark" placeholder="Your Comment" name="comment"></textarea>
                            <input type="hidden" name="show_id" value="<?php echo $id; ?>">
                            <button type="submit" name="inserting_comment"><i class="fa fa-location-arrow"></i>
                                Comment</button>
                        </form>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="anime__details__sidebar">
                        <?php foreach($allforyouShows as $foryourshow) : ?>
                        <div class="section-title">
                            <h5>you might like...</h5>
                        </div>
                        <div class="product__sidebar__view__item set-bg"
                            data-setbg="<?php echo IMAGEURL ;?>/<?php echo htmlspecialchars($foryourshow->image, ENT_QUOTES, 'UTF-8'); ?>">
                            <div class="ep">
                                <?php echo htmlspecialchars($foryourshow->num_available, ENT_QUOTES, 'UTF-8'); ?> /
                                <?php echo htmlspecialchars($foryourshow->num_total, ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            <div class="view"><i class="fa fa-eye"></i>
                                <?php echo htmlspecialchars($foryourshow->count_views, ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            <h5><a
                                    href="<?php echo APPURL; ?>/anime-details.php?id=<?php echo htmlspecialchars($foryourshow->id, ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($foryourshow->title, ENT_QUOTES, 'UTF-8'); ?>
                                </a></h5>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Anime Section End -->

<?php require "includes/footer.php"; ?>