<?php
$entries = $conn->query("SELECT * FROM " . $_SESSION['table'] . " WHERE id = " . $_SESSION['id']);
$row = $entries->fetch_assoc();

// IF CHANGE BUTTON IS CLICKED
if (isset($_POST['change'])) {
    // IF IMAGE IS UPLOADED
    if (!empty($_FILES['image']['tmp_name'][0])) {
        $imgArr = json_decode($row['image']);
        // PUSHING IMAGE TO ARRAY
        for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
            array_push($imgArr, $_FILES['image']['name'][$i]);
        }
        $imgJson = json_encode($imgArr);
        // SQL COMMAND WITH UPLOADING IMAGES
        $change = "UPDATE " . $_SESSION['table'] . " SET `title` = '" . $_POST['title'] . "', `descrip` = '" . $_POST['descrip'] . "', `image` = '" . $imgJson . "', `price` = '" . $_POST['price'] . "' WHERE `id` = " . $row['id'];
    } else {
        // SQL COMMAND WITHOUT UPLOADING IMAGES
        $change = "UPDATE " . $_SESSION['table'] . " SET `title` = '" . $_POST['title'] . "', `descrip` = '" . $_POST['descrip'] . "', `price` = '" . $_POST['price'] . "' WHERE `id` = " . $row['id'];
    }
    if ($conn->query($change)) {
        // STORING IMAGES TO FOLDER
        for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
            move_uploaded_file($_FILES['image']['tmp_name'][$i], "image/" . $_FILES['image']['name'][$i]);
        }
        $_SESSION['msg'] = "Successfully Changed";
        unset($_POST);
    } else {
        $_SESSION['msg'] = "Unable to change" . $conn->error;
    }
}
// IF DELETE BUTTON IS CLICKED
if(isset($_POST['delete'])){
    $imgArr = json_decode($row['image']);
    for($i=0;$i<count($imgArr);$i++){
        unlink("image/".$_SESSION['table']."/$imgArr[$i]");
    }
    $deleting = "DELETE FROM ".$_SESSION['table']." WHERE id=".$row['id'];
    if($conn->query($deleting)){
        unset($_SESSION['id']);
        header("Location:Dashboard.php");
    }
}
?>
<!-- BACK BUTTON -->
<div class="back">
    <form action="upload/nav.php" method="POST">
        <button type="submit" value="id" name="back" class="btn back">
            <i class="fas fa-angle-left"></i>
        </button>
    </form>
</div>
<!-- FORM TO CHANGE THE PRODUCT INFO -->
<form action="" method="POST" enctype="multipart/form-data" class="jumbotron edit">
    <?php if (isset($_SESSION['msg'])) { ?>
        <h5 class="mb-4"><?php echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        } ?></h5>
        <!-- IMAGES -->
        <div class="row mb-2">
            <?php for ($i = 0; $i < sizeof(json_decode($row['image'])); $i++) { ?>
                <img src="image/<?php echo $_SESSION['table'] . "/" . json_decode($row['image'])[$i] ?>" class="col" />
            <?php } ?>
        </div>
        <!-- ADD IMAGE -->
        <div class="custom-file">
            <input type="file" class="custom-file-input text-hide" id="customFile" name="image[]" multiple>
            <label class="custom-file-label" for="customFile">Add Image</label>
        </div>
        <!-- TITLE OF PRODUCT -->
        <div class="form-group mt-4">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" value="<?php echo $row['title'] ?>" placeholder="Enter Title" name="title">
        </div>
        <!-- DESCRIPTION OF PRODUCT -->
        <div class="form-group mt-4">
            <label for="descrip">Description:</label>
            <textarea class="form-control" id="descrip" placeholder="Enter Description" rows="5" name="descrip"><?php echo $row['descrip']; ?></textarea>
        </div>
        <!-- PRICE OF PRODUCT -->
        <div class="form-group mt-4">
            <label for="price">Price:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">₹</span>
                </div>
                <input type="number" class="form-control" id="price" value="<?php echo $row['price'] ?>" placeholder="Enter Price" name="price">
            </div>
        </div>
        <!-- CHANGE BUTTON -->
        <div class="form-group mt-4">
            <input type="submit" value="Change" name="change" class="btn btn-warning">
        </div>
        <!-- DELETE BUTTON -->
        <div class="form-group mt-4">
            <input type="submit" value="Delete" name="delete" class="btn btn-danger">
        </div>
</form>