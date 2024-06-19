<?php require("../config/config.php"); ?>
<?php require("../includes/header.php");?>

<?php 

    if (!isset($_SESSION['user_id'])) {
        echo ("<script>location.href='".APPURL."'</script>");
    }

    $followings = $conn->query("SELECT shows.id AS id, shows.title AS title, shows.image AS image, 
        shows.type AS type, shows.genre AS genre, shows.number_available AS num_available, shows.num_total AS num_total, 
        followings.user_id, followings.show_id 
        FROM shows 
        INNER JOIN followings ON shows.id = followings.show_id 
        WHERE followings.user_id = '$_SESSION[user_id]'");

    $followings->execute();
    $allFollowings = $followings->fetchAll(PDO::FETCH_OBJ);


?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="<?php echo APPURL; ?>"><i class="fa fa-home"></i> Home</a>
                    <span>Following</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Section Begin -->
<section class="product-page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="product__page__content">
                    <div class="product__page__title">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-6">
                                <div class="section-title">
                                    <h4>Following</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <?php if(count($allFollowings) > 0) : ?>
                        <?php foreach($allFollowings as $show) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="<?php echo APPURL; ?>/img/<?php echo $show->image; ?>">
                                    <div class="ep">
                                        <?php echo $show->num_available; ?> /
                                        <?php echo $show->num_total; ?>
                                    </div>
                                </div>
                                <div class="product__item__text">
                                    <ul>
                                        <li>
                                            <?php echo $show->genre; ?>
                                        </li>
                                        <li>
                                            <?php echo $show->type; ?>
                                        </li>
                                    </ul>
                                    <h5><a href="<?php echo APPURL; ?>/anime-details.php?id=<?php echo $show->id; ?>">
                                            <?php echo $show->title; ?>
                                        </a></h5>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <marquee>
                            <p style="color: white;">No show this genre just yet</p>
                        </marquee>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="product__sidebar">
                    <div class="product__sidebar__view">
                    </div>
                    <!-- </div>
                </div>         -->
                </div>

            </div>
        </div>
    </div>
    </div>
</section>
<!-- Product Section End -->

<?php 
    require("../includes/footer.php");

?>