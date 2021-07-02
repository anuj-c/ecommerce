<?php
session_start();
require_once 'dbConfig.php';
require 'vendor/autoload.php';
// $tables = $conn->query("SELECT TABLE_NAME FROM information_schema.tables WHERE TABLE_SCHEMA = 'ecommerce' AND TABLE_COMMENT <> 'private'");
$tables = $conn->query("SELECT * from categories WHERE table_comment = 'open';");
$table = $tables->fetch_all();
// print_r($table);

if (!isset($_SESSION['showall-table'])) {

    require "templates/views/testheader.php";
?>
    <section class="slider">
        <div id="main_slider" class="section carousel slide banner-main" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main_slider" data-slide-to="0" class="active"></li>
                <li data-target="#main_slider" data-slide-to="1"></li>
                <li data-target="#main_slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container" style="margin-top: -100px;">
                        <div class="row marginii">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="carousel-caption ">
                                    <h1>Welcome to <strong class="color">Our Shop</strong></h1>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                                    <a class="btn btn-lg btn-primary" href="#" role="button">Buy Now</a>
                                    <a class="btn btn-lg btn-primary" href="#" role="button">About </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="img-box">
                                    <figure><img src="images/child-image.png" alt="img" /></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container" style="margin-top: -100px;">
                        <div class="row marginii">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="carousel-caption ">
                                    <h1>Holiday Season <strong class="color">is here</strong></h1>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                                    <a class="btn btn-lg btn-primary" href="#" role="button">Buy Now</a>
                                    <a class="btn btn-lg btn-primary" href="#" role="button">About</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="img-box ">
                                    <figure><img src="images/t-shirt.png" alt="img" /></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="container" style="margin-top: -100px;">
                        <div class="row marginii">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="carousel-caption ">
                                    <h1>Welcome to <strong class="color">Our Shop</strong></h1>
                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                                    <a class="btn btn-lg btn-primary" href="#" role="button">Buy Now</a>
                                    <a class="btn btn-lg btn-primary" href="#" role="button">About</a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="img-box">
                                    <figure><img src="img/boksing-gloves.png" alt="img" /></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev makeLight" href="#main_slider" role="button" data-slide="prev">
                <i class='fa fa-angle-left'></i></a>
            <a class="carousel-control-next makeLight" href="#main_slider" role="button" data-slide="next">
                <i class='fa fa-angle-right'></i>
            </a>
        </div>
    </section>

    <?php for ($i = 0; $i < $tables->num_rows; $i++) {
        $categ = $conn->query("SELECT id,image,title,price FROM " . $table[$i][1] . " ORDER BY time LIMIT 6"); ?>
        <form action="upload/nav.php" method="POST">
            <div id="plant" class="section product">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titlepage">
                                <h2><strong class="black text-uppercase"><?php echo $table[$i][1] ?></strong> Clothing <button style="font-size: 1.5rem;float:right;border:2px solid black;" class="btn border-1 text-monospace" value="<?php echo $table[$i][1] ?>" name="showall">Show all<i class='fas fa-arrow-alt-circle-right'></i></button></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clothes_main section">
                <div class="container">
                    <div class="row">
                        <?php if ($categ->num_rows > 0) {
                            while ($row = $categ->fetch_assoc()) { ?>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                    <input type="text" value="<?php echo $table[$i][1] ?>" name="showall" hidden>
                                    <button class="mx-2 mt-2 bg-light border btn" name="product" value="<?php echo $row['id'] ?>">
                                        <img src="image/<?php echo $table[$i][1] . "/" . json_decode($row['image'])[0] ?>" />
                                        <h3>₹<strong class="price_text"><?php echo $row['price'] ?></strong></h3>
                                        <h4 class="text-uppercase"><?php echo $row['title'] ?></h4>
                                    </button>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </form>
    <?php } ?>

<?php
    require "templates/views/testfooter.php";
} else {
    require "templates/display/testshowall.php";
}
?>