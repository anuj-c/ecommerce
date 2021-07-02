<?php
$items = $conn->query("SELECT id,title,image,price FROM " . $_SESSION['showall-table']);

if (!isset($_SESSION['product'])) { ?>
    <h1 class="display-4 text-uppercase font-weight-bold text-muted ml-4 text-center" style="position: relative;">
        <form action="upload/nav.php" method="POST">
            <button type="submit" value="showall-table" name="back-index" class="btn back d-flex align-items-center">
                <i class="fas fa-angle-left"></i>
                <span class="text-monospace">BACK</span>
            </button>
        </form>
        <?php echo $_SESSION['showall-table'] ?>
    </h1>
    <?php if ($items) { ?>
        <form action="upload/nav.php" method="post" class="mt-4">
            <?php for ($j = 0; $j < $items->num_rows; $j++) { ?>
                <div class="container d-flex justify-content-center showing my-5">
                    <?php for ($i = 0; $i < 5 && $row = $items->fetch_assoc(); $i++, $j++) { ?>
                        <button class="mx-2 bg-light border btn" name="product" value="<?php echo $row['id'] ?>">
                            <img src="image/<?php echo $_SESSION['showall-table'] . "/" . json_decode($row['image'])[0] ?>" />
                            <h4 class="text-center text-monospace my-0"><?php echo $row['title'] ?></h4>
                            <h5 class="text-center text-monospace my-0">₹<?php echo $row['price'] ?></h5>
                        </button>
                    <?php } ?>
                </div>
            <?php } ?>
        </form>
<?php } else {
        echo "<h5 class='text-center text-danger'>No items</h5>";
    }
} else {
    require "templates/display/product.php";
} ?>