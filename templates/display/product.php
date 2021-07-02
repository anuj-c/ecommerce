<?php
$product = $conn->query("SELECT * FROM " . $_SESSION['showall-table'] . " WHERE id=" . $_SESSION['product']);
$row = $product->fetch_assoc();
?>
<form action="upload/nav.php" method="POST">
    <button type="submit" value="product" name="back-index" class="btn back d-flex align-items-center">
        <i class="fas fa-angle-left"></i>
        <span class="text-monospace">BACK</span>
    </button>
</form>
<h1 class="display-3 text-uppercase text-center" style="position: relative;"><?php echo $row['title'] ?></h1>
<div class="container-fluid product-page mb-5 px-4">
    <div class="row">
        <!-- IMAGE CAROUSEL -->
        <div class="p-2 d-flex justify-content-center" style="position: relative;">
            <div class="carousel slide" id="prod-img" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#prod-img" data-slide-to="0" class="active">
                        <img src="image/<?php echo $_SESSION['showall-table'] . "/" . json_decode($row['image'])[0] ?>" alt="" class="side-img">
                    </li>
                    <?php for ($i = 1; $i < count(json_decode($row['image'])); $i++) { ?>
                        <li data-target="#prod-img" data-slide-to="<?php echo $i ?>">
                            <img src="image/<?php echo $_SESSION['showall-table'] . "/" . json_decode($row['image'])[$i] ?>" alt="" class="side-img">
                        </li>
                    <?php } ?>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="image/<?php echo $_SESSION['showall-table'] . "/" . json_decode($row['image'])[0] ?>" alt="" class="main-img">
                    </div>
                    <?php for ($i = 1; $i < count(json_decode($row['image'])); $i++) { ?>
                        <div class="carousel-item">
                            <img src="image/<?php echo $_SESSION['showall-table'] . "/" . json_decode($row['image'])[$i] ?>" alt="" class="main-img">
                        </div>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#prod-img" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#prod-img" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <div class="p-2 descrip">
            <span class="text-monospace bg-info p-2 rounded text-white">Price : ₹ <?php echo $row['price'] ?></span>
            <br><br>
            <p class="text-monospace lead"><?php echo $row['descrip'] ?></p>
            <button class="order btn btn-primary my-4">Order</button>
            <?php if(isset($_SESSION['orderMsg'])){ ?>
            <h3 class="text-monospace text-center badge badge-success"><?php echo $_SESSION['orderMsg'] ?></h3>
            <?php unset($_SESSION['orderMsg']); } ?>
        </div>
        <div class="p-3 order-details jumbotron">
            <h2 class="text-center">Order Details</h2>
            <form action="upload/nav.php" method="post" class="order">
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" value="1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="addr">Address</label>
                    <textarea name="addr" class="form-control" rows="2" required></textarea>
                </div>
                <div class="form-group">
                    <label for="phn">Phone Number</label>
                    <input type="tel" name="phn" class="form-control" required>
                </div>
                <button class="btn btn-primary my-4" name="order" value="<?php echo $row['id'] ?>">Order</button>
            </form>
        </div>
    </div>
</div>