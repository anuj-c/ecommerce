<?php
require_once 'dbConfig.php';
// require_once 'vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();
$var = getenv('PASS');
// session_start();
if (isset($_POST['login'])) {
    $salt = $var;
    $pass = hash('sha256', $_POST['password'] . $salt);

    //  FOR LOGIN
    $sql = $conn->query("SELECT * FROM login WHERE name='" . $_POST['email'] . "'");
    if ($sql->num_rows > 0) {
        $row = $sql->fetch_assoc();
        if (strcmp($pass, $row['password']) == 0) {
            // $_SESSION['login'] = $row['email'];
            setcookie('login', $row['name'], time() + (86400 * 3), "/");
            header("Location:Dashboard.php");
        } else {
            echo "<p class='display-4 text-center text-danger'>Wrong Password or email</p>";
        }
    } else {
        echo "Error" . $conn->error;
    }

    //FOR REGISTRATION
    // $sql = $conn->query("INSERT INTO login (name,password) VALUES ('" . $_POST['email'] . "', '$pass')");
    // echo "<p class='display-4 text-center text-danger'>Done Password or email</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>

    <link rel="icon" href="http://simpleicon.com/wp-content/uploads/basket.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .container {
            max-width: 50%;
        }

        input[type=submit] {
            margin-left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <h1 class="text-center display-2">Login</h1>
    <form action="" method="post" class="container jumbotron">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <input type="submit" value="Login" name="login" class="btn btn-primary">
    </form>
</body>

</html>