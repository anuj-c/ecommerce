<h1 class="display-4">Add items</h1>
<?php
require_once "dbConfig.php";
// GETTING TABLE
$tables = $conn->query("SELECT * from categories WHERE table_comment = 'open';");
?>

<div class="jumbotron add">
<!-- IF BUTTON IS NOT CLICKED -->
    <?php if (!isset($_POST['add'])) { ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="">
<!-- ALREADY EXISTING CATEGORIES -->
                <label for="categ">Category:</label>
                <select name="categ" id="" class="custom-select">
                    <?php if ($tables->num_rows > 0) {
                        while ($row = $tables->fetch_assoc()) { ?>
                            <option value="<?php echo $row['table_name']; ?>"><?php echo strtoupper($row['table_name']); ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
<!-- NEW CATEGORY -->
            <div class="form-group mt-4" id="ncateg">
                <label for="nCateg">New Category:</label>
                <input type="text" name="nCateg" class="form-control">
                <?php if (isset($_SESSION['cate-msg'])) { ?>
                    <p class="text-danger"><?php echo $_SESSION['cate-msg'] ?></p>
                <?php unset($_SESSION['cate-msg']);
                } ?>
            </div>
<!-- TITLE -->
            <div class="form-group mt-4">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control">
                <?php if (isset($_SESSION['title-msg'])) { ?>
                    <p class="text-danger"><?php echo $_SESSION['title-msg'] ?></p>
                <?php unset($_SESSION['title-msg']);
                } ?>
            </div>
<!-- DESCRIPTION -->
            <div class="form-group mt-4">
                <label for="descrip">Description:</label>
                <textarea name="descrip" class="form-control" rows="5"></textarea>
            </div>
<!-- PRICE -->
            <div class="form-group mt-4">
                <label for="price">Price:</label>
                <input type="number" name="price" class="form-control">
            </div>
<!-- UPLOADING IMAGE -->
            <div class="mt-4">
                <label for="image" class="">Upload Image:</label>
                <input type="file" name="image[]" class="" value="" multiple>
            </div>
<!-- SUBMITTING BUTTON -->
            <div class="form-group container mt-4">
                <input type="submit" name="add" class="btn-primary form-control">
            </div>
        </form>
<!-- IF SUBMIT BUTTON IS CLICKED -->
        <?php } else {
// CHECKING IF TITLE IS TAKEN
        if (isset($_POST['categ'])) {
            $titleCheck = "SELECT id FROM " . $_POST['categ'] . " WHERE title='" . $_POST['title'] . "'";
            $result = $conn->query($titleCheck);
            if ($result->num_rows > 0) {
                $_SESSION['title-msg'] = "Title already taken";
                unset($_POST);
                header("Location:Dashboard.php");
            }
        ?>
<!-- PRINTING SELECTED CATEGORY -->
            <h4>Category : <u><?php echo $_POST['categ']; ?></u></h4>
<!-- IF NEW CATEGORY IS WRITTEN -->
        <?php } else {
            $checkTable = "SELECT table_name FROM information_schema.tables WHERE table_name='" . $_POST['nCateg'] . "'";
            $result = $conn->query($checkTable);
// CHECKING IS TABLE ALREADY EXISTS
            if ($result->num_rows > 0) {
                $_SESSION['cate-msg'] = "Table already exists";
                unset($_POST);
                header("Location:Dashboard.php");
// CREATING NEW TABLE
            } else {
                $createTable = "CREATE TABLE " . $_POST['nCateg'] . " ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(255) NOT NULL , `descrip` TEXT NOT NULL , `image` JSON NOT NULL , `price` INT NOT NULL , `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB";
                $tableentry = "INSERT INTO categories (table_name) VALUES ('". $_POST['nCateg'] ."')";
                $conn->query($tableentry);
                if ($conn->query($createTable)) {
                    $_POST['categ'] = $_POST['nCateg'];
                } else {
                    echo $conn->error;
                }
            }
        ?>
<!-- PRINTING SELECTED CATEGORY -->
            <h4>Category : <u><?php echo $_POST['nCateg']; ?></u></h4>
        <?php } ?>
<!-- PRINTING OTHER VALUES -->
        <h4>Title : <u><?php echo $_POST['title']; ?></u></h4>
        <h4>Description : <i>"<?php echo $_POST['descrip'] ?>"</i></h4>
        <h4>Price : <u>₹ <?php echo $_POST['price']; ?> /-</u></h4>
        <h4>Images :</h4>
<!-- SHOWING ALL THE IMAGES -->
        <div class="row after-adding">
            <?php for ($i = 0; $i < count($_FILES['image']['tmp_name']); $i++) { ?>
                <div class="col">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode(file_get_contents($_FILES['image']['tmp_name'][$i])) ?>" alt="">
                </div>
            <?php } ?>
        </div>
<!-- UPLOADING TO DATABASE -->
    <?php
        $json = json_encode($_FILES['image']['name']);
        // SQL COMMAND
        $sql = "INSERT INTO " . $_POST['categ'] . " (title,descrip,price,image) VALUES ('" . $_POST['title'] . "','" . $_POST['descrip'] . "','" . $_POST['price'] . "','" . $json . "')";

        if ($conn->query($sql)) {
            // MAKING NEW DIRECTORY IS DOES NOT EXIST
            if (!is_dir("image/".$_POST['categ'])) {
                mkdir("image/".$_POST['categ']);
            }
            // UPLOADING IMAGES TO FOLDER
            for ($i = 0; $i < count($_FILES['image']['name']); $i++) {
                move_uploaded_file($_FILES['image']['tmp_name'][$i], "image/" . $_POST['categ'] . "/" . $_FILES['image']['name'][$i]);
            }
            echo "<h3 class='text-success'>Successfully added</h3>";
        } else {
            echo $conn->error;
        }
    } ?>
</div>