<!-- PAGE FOR TABLES OR CATEGORIES -->
<h1 class="display-4">Dashboard</h1>
<?php

require_once "dbConfig.php";
// GETTING ALL TABLES
$tables = $conn->query("SELECT * from categories WHERE table_comment = 'open';");
// print_r($tables->fetch_assoc());
?>
<div class="container">
<!-- BEFORE SELECTING ANY CATEGORY -->
    <?php if(!isset($_SESSION['table'])){ ?>
    <form action="upload/nav.php" method="POST" class="tableNames">
        <?php if ($tables->num_rows > 0) { ?>
            <?php while ($row = $tables->fetch_assoc()) { ?>
                <input type="submit" value="<?php echo $row['table_name']; ?>" name="table" class="container my-2 btn btn-primary py-3 pl-5">
        <?php }
        } ?>
    </form>
    <?php }
    if(isset($_SESSION['table'])){
//  REQUIRING SPECIFIC CATEGORY OR TABLE
        require 'templates/dashFiles/dashTable.php';
    }    
    ?>
</div>