<?php
//  ALL ENTRIES IN A SPECIFIC TABLE
$entries = $conn->query("SELECT id,image,title FROM " . $_SESSION['table']);
// BEFORE SELECTING ANY PRODUCT
if (!isset($_SESSION['id'])) {
    if ($entries->num_rows > 0) { ?>
        <form method="POST" action="upload/nav.php" class="list-group dash-table">
            <?php while ($row = $entries->fetch_assoc()) { ?>
<!-- SHOWING IMAGES, TITLE AND EDIT BUTTON -->
                <div class="list-group-item">
                    <img src="image/<?php echo $_SESSION['table']."/".json_decode($row['image'])[0] ?>" />
                    <span class="ml-5"><?php echo $row['title']; ?></span>
                    <span class="edit-btn">
                        <button type="submit" value="<?php echo $row['id']; ?>" name="id" class="btn btn-block btn-dark">Edit</button>
                    </span>
                </div>
            <?php } ?>
        </form>
<?php } else echo "No items";
}else if(isset($_SESSION['id'])){
    //  REQUIRING EDIT PAGE FOR A PRODUCT
    require 'templates/dashFiles/edit.php';
} ?>