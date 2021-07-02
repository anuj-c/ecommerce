<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-commerce</title>

    <link rel="icon" href="http://simpleicon.com/wp-content/uploads/basket.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/main.css">
    <style>
        form#navbar{
            background: #136af8;
        }
        #navbar li button,#navbar li a{
            color: white;
            text-transform: uppercase;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <form method="POST" action="upload/nav.php" id="navbar" class="navbar navbar-expand">
        <button value="home" class="navbar-brand" name="back-index"><img src="img/brand2.png" alt=""></button>
        <div class="container">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <button class="nav-link btn" value="mens" name="showall">Men</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn" value="womens" name="showall">Women</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn" value="kids" name="showall">Kids</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn" disabled>Offers</button>
                </li>
                <li class="nav-item">
                    <a href="#footer" class="nav-link btn">Contact Us</a>
                </li>
            </ul>
        </div>
    </form>