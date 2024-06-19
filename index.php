<?php include "includes/header.php"; ?>
<?php include "config/config.php"; ?>

<?php

    $shows = $conn->query("SELECT * FROM shows LIMIT 3");
    // $shows->execute();

    $allShows = $shows->fetchAll(PDO::FETCH_OBJ);

    // trending shows
    $trendingShows = $conn->query("
    SELECT shows.id AS id, shows.image AS image, shows.number_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type, 
    COUNT(views.show_id) AS count_views 
    FROM shows 
    JOIN views ON shows.id = views.show_id 
    GROUP BY (shows.id) ORDER BY views.show_id ASC
    ");

    $trendingShows->execute();
    $allTrandingShows = $trendingShows->fetchAll(PDO::FETCH_OBJ);


    // Adventure shows
    $adventureShows = $conn->query("
    SELECT shows.id AS id, shows.image AS image, shows.number_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type, 
    COUNT(views.show_id) AS count_views 
    FROM shows 
    JOIN views ON shows.id = views.show_id 
    WHERE shows.genre = 'Adventure' GROUP BY(shows.id) ORDER BY views.show_id ASC
    ");

    $adventureShows->execute();
    $alladventureShows = $adventureShows->fetchAll(PDO::FETCH_OBJ);

    // var_dump($alladventureShows);


    // recentlyAdded shows
    $recentlyAddedShows = $conn->query("
    SELECT shows.id AS id, shows.image AS image, shows.number_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type, 
    COUNT(views.show_id) AS count_views 
    FROM shows 
    JOIN views ON shows.id = views.show_id 
    GROUP BY(shows.id) ORDER BY shows.created_at DESC
    ");

    $recentlyAddedShows->execute();
    $allrecentlyAddedShows = $recentlyAddedShows->fetchAll(PDO::FETCH_OBJ);


    // Action shows
    $actionShows = $conn->query("
    SELECT shows.id AS id, shows.image AS image, shows.number_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type, 
    COUNT(views.show_id) AS count_views 
    FROM shows 
    JOIN views ON shows.id = views.show_id 
    WHERE shows.genre = 'Action' GROUP BY(shows.id) ORDER BY views.show_id ASC
    ");

    $actionShows->execute();
    $allActionShows = $actionShows->fetchAll(PDO::FETCH_OBJ);


    // FORYOU shows
    $foryouShows = $conn->query("
    SELECT shows.id AS id, shows.image AS image, shows.number_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type, 
    COUNT(views.show_id) AS count_views 
    FROM shows 
    JOIN views ON shows.id = views.show_id 
    GROUP BY(shows.id) ORDER BY views.show_id ASC
    ");

    $foryouShows->execute();
    $allforyouShows = $foryouShows->fetchAll(PDO::FETCH_OBJ);



?>


<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            <?php foreach($allShows as $show): ?>
            <div class="hero__items set-bg" data-setbg="<?php echo IMAGEURL ;?>/<?php echo $show->image; ?>">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero__text">
                            <div class="label">
                                <?php echo $show->genre; ?>
                            </div>
                            <h2>
                                <?php echo $show->title; ?>
                            </h2>
                            <p>
                                <?php echo $show->description; ?>
                            </p>
                            <a href="<?php echo APPURL; ?>/anime-watching.php?id=<?php echo $show->id; ?>&ep=1"><span>Watch Now</span> <i
                                    class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Trending Now</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <!-- <div class="btn__all">
                                <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach($allTrandingShows as $trandingShow) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="<?php echo IMAGEURL ;?>/<?php echo $trandingShow->image; ?>">
                                    <div class="ep">
                                        <?php echo $trandingShow->num_available; ?> /
                                        <?php echo $trandingShow->num_total; ?>
                                    </div>
                                    <div class="view"><i class="fa fa-eye"></i>
                                        <?php echo $trandingShow->count_views; ?>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <ul>
                                        <li>
                                            <?php echo $trandingShow->genre; ?>
                                        </li>
                                        <li>
                                            <?php echo $trandingShow->type; ?>
                                        </li>
                                    </ul>
                                    <h5><a href="anime-details.php?id=<?php echo $trandingShow->id; ?>">
                                            <?php echo $trandingShow->title; ?>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="popular__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Adventure Shows</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="<?php echo APPURL; ?>/categories.php?name=Adventure" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach($alladventureShows as $adventure) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="<?php echo IMAGEURL ;?>/<?php echo $adventure->image; ?>">
                                    <div class="ep">
                                        <?php echo $adventure->num_available; ?> /
                                        <?php echo $adventure->num_total; ?>
                                    </div>
                                    <div class="view"><i class="fa fa-eye"></i>
                                        <?php echo $adventure->count_views; ?>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <ul>
                                        <li>
                                            <?php echo $adventure->genre; ?>
                                        </li>
                                        <li>
                                            <?php echo $adventure->type; ?>
                                        </li>
                                    </ul>
                                    <h5><a
                                            href="<?php echo APPURL; ?>/anime-details.php?id=<?php echo $adventure->id; ?>">
                                            <?php echo $adventure->title; ?>
                                        </a></h5>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="recent__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Recently Added Shows</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <!-- <div class="btn__all">
                                <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach($allrecentlyAddedShows as $recentlyAdded) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="<?php echo IMAGEURL ;?>/<?php echo $recentlyAdded->image; ?>">
                                    <div class="ep">
                                        <?php echo $recentlyAdded->num_available; ?> /
                                        <?php echo $recentlyAdded->num_total; ?>
                                    </div>
                                    <div class="view"><i class="fa fa-eye"></i>
                                        <?php echo $recentlyAdded->count_views; ?>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <ul>
                                        <li>
                                            <?php echo $recentlyAdded->genre; ?>
                                        </li>
                                        <li>
                                            <?php echo $recentlyAdded->type; ?>
                                        </li>
                                    </ul>
                                    <h5><a
                                            href="<?php echo APPURL; ?>/anime-details.php?id=<?php echo $recentlyAdded->id; ?>">
                                            <?php echo $recentlyAdded->title; ?>
                                        </a></h5>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="live__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Live Action</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="btn__all">
                                <a href="<?php echo APPURL; ?>/categories.php?name=Action" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach($allActionShows as $allAction) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="<?php echo IMAGEURL ;?>/<?php echo $allAction->image; ?>">
                                    <div class="ep">
                                        <?php echo $allAction->num_available; ?> /
                                        <?php echo $allAction->num_total; ?>
                                    </div>
                                    <div class="view"><i class="fa fa-eye"></i>
                                        <?php echo $allAction->count_views; ?>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <ul>
                                        <li>
                                            <?php echo $allAction->genre; ?>
                                        </li>
                                        <li>
                                            <?php echo $allAction->type; ?>
                                        </li>
                                    </ul>
                                    <h5><a href="<?php APPURL; ?>/anime-detail.php?id= <?php echo $allAction->id; ?> ">
                                            <?php echo $allAction->title; ?>
                                        </a></h5>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="product__sidebar">
                    <div class="product__sidebar__view">
                    </div>
                </div>
                <div class="product__sidebar__comment">
                    <div class="section-title">
                        <h5>For You</h5>
                    </div>
                    <?php foreach($allforyouShows as $allforyou) : ?>
                    <div class="product__sidebar__comment__item">
                        <div class="product__sidebar__comment__item__pic">
                            <img src="<?php echo IMAGEURL ;?>/<?php echo $allforyou->image; ?>" height="60px" width="auto" alt="">
                        </div>
                        <div class="product__sidebar__comment__item__text">
                            <ul>
                                <li>
                                    <?php echo $allforyou->genre; ?>
                                </li>
                                <li>
                                    <?php echo $allforyou->type; ?>
                                </li>
                            </ul>
                            <h5><a href="<?php APPURL; ?>/anime-detail.php?id= <?php echo $allAction->id; ?>">
                                    <?php echo $allforyou->title; ?>
                                </a></h5>
                            <span><i class="fa fa-eye"></i>
                                <?php echo $allforyou->count_views; ?> Viewes
                            </span>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Product Section End -->

<?php 
    include "includes/footer.php";
?>