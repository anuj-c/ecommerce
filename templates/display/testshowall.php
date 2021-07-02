<?php
$items = $conn->query("SELECT id,title,image,price FROM " . $_SESSION['showall-table']);

if (!isset($_SESSION['product'])) {
require "templates/views/testheader.php";
?>
    <?php if ($items) { ?>
        <form action="upload/nav.php" method="post">
            <div id="plant" class="section product">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="titlepage">
                                <h2><strong class="black text-uppercase"><?php echo $_SESSION['showall-table'] ?></strong> Clothing <button style="font-size: 1.5rem;float:right;border:2px solid black;" class="btn border-1 text-monospace" value="showall-table" name="back-index"><i class="fas fa-angle-left"></i>Back</button></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clothes_main section">
                <div class="container">
                    <div class="row">
                        <?php for ($j = 0; $j < $items->num_rows; $j++) { ?>
                            <?php for ($i = 0; $i < 5 && $row = $items->fetch_assoc(); $i++, $j++) { ?>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                    <button class="sport_product" name="product" value="<?php echo $row['id'] ?>">
                                        <figure><img src="image/<?php echo $_SESSION['showall-table'] . "/" . json_decode($row['image'])[0] ?>" /></figure>
                                        <h3>₹<strong class="price_text"><?php echo $row['price'] ?></strong></h3>
                                        <h4 class="text-uppercase"><?php echo $row['title'] ?></h4>
                                    </button>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
<?php 
require "templates/views/testfooter.php";
} else {
        echo "<h5 class='text-center text-danger'>No items</h5>";
    }
} else {
    require "templates/display/testproduct.php";
} ?>