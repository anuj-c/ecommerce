<?php
session_start();
if(!isset($_COOKIE['login'])){
    header("Location:auth.php");
}else{
require "templates/views/sidenav.php";
?>
    <div class=" container-fluid col-10 right">
        <?php
            if(isset($_SESSION["menu"])){
                $str = 'upload/'.$_SESSION["menu"].'.php';
                require $str;
            }else{
                require 'upload/dashboard.php';
            }
        ?>
    </div>
</div>
<script src="js/main.js"></script>
<?php } ?>
</body>
</html>