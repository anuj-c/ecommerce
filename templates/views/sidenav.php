<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="icon" href="http://simpleicon.com/wp-content/uploads/basket.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="row">
        <nav id="sidebar" class="d-flex flex-column text-center container col-2">
            <a href="#" class="navbar-brand mt-5 mx-auto"><img src="img/brand2.png" alt=""></a>
            <form method="post" action="upload/nav.php">
                <input type="submit" value="Dashboard" name="menu" class="nav-link btn text-white mx-auto my-4">
                <input type="submit" value="Add" name="menu" class="nav-link btn text-white mx-auto my-4">
                <input type="submit" value="Orders" name="menu" class="nav-link btn text-white mx-auto my-4">
                <input type="submit" value="Logout" name="menu" class="nav-link btn text-white mx-auto my-4">
            </form>
        </nav>