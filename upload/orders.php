<?php
require_once 'dbConfig.php';
$get_table = $conn->query("SELECT * FROM orders ORDER BY completed,time");
?>
<h1 class="display-4">Orders</h1>
<div class="container">
    <form action="upload/nav.php" method="post" class="order-table container">
        <?php while ($row = $get_table->fetch_assoc()) {
            $gProd = $conn->query("SELECT * FROM " . $row['prod.category'] . " WHERE id = " . $row['prod.id']);
            $prod = $gProd->fetch_assoc(); ?>
            <div class="row border p-2">
                <div class="">
                    <img src="image/<?php echo $row['prod.category'] . "/" . json_decode($prod['image'])[0] ?>" />
                </div>
                <div class="col">
                    <b class="text-monospace my-3"><?php echo $prod['title'] . " (" . $row['prod.category'] . ")"; ?></b>
                    <p class="text-monospace my-3">Quantity : <kbd class="px-2"><?php echo $row['quantity'] ?></kbd></p>
                    <p class="text-monospace mt-3 mb-0">
                        Address :
                        <kbd class="text-capitalize">
                            <?php echo $row['address'] ?>
                        </kbd>&nbsp;&nbsp;
                        Phone Number :
                        <kbd class="text-capitalize">
                            <?php echo $row['phoneNo'] ?>
                        </kbd>
                    </p>
                </div>
                <div class="">
                    <h2><span class="badge badge-info badge-pill">₹ <?php echo $prod['price'] ?></span></h2>
                    <?php if ($row['completed'] == 1) { ?>
                        <p><i class="fas fa-check" style="font-size: 100px; left:10px; bottom:10px; color:green;"></i></p>
                        <button class="btn btn-danger" name="order-clear" value="<?php echo $row['id'] ?>">DELETE</button>
                    <?php } else { ?>
                        <button class="btn btn-success" name="order-complete" value="<?php echo $row['id'] ?>">COMPLETE</button>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </form>
</div>