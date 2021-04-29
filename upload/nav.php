<?php
    session_start();
    if (isset($_POST['menu'])) {
        $_SESSION['menu'] = strtolower($_POST['menu']);
        if ($_SESSION['menu'] == "dashboard") {
            $email = $_SESSION['login'];
            session_unset();
            $_SESSION['login'] = $email;
        }
        if ($_SESSION['menu'] == "logout") {
            setcookie('login','',time()-30,'/');
            session_destroy();
        }
        header("Location:../Dashboard.php");
    }
    if (isset($_POST['table'])) {
        $_SESSION['table'] = strtolower($_POST['table']);
        header("Location:../Dashboard.php");
    }
    if (isset($_POST['id'])) {
        $_SESSION['id'] = $_POST['id'];
        header("Location:../Dashboard.php");
    }
    if (isset($_POST['back'])) {
        $n = $_POST['back'];
        unset($_SESSION["$n"]);
        header("Location:../Dashboard.php");
    }
    if (isset($_POST['back-index'])) {
        if ($_POST['back-index'] == "home") {
            session_unset();
        } else {
            $n = $_POST['back-index'];
            unset($_SESSION["$n"]);
        }
        header("Location:../");
    }
    if (isset($_POST['showall'])) {
        if(isset($_SESSION['product'])){
            unset($_SESSION['product']);
        }
        $_SESSION['showall-table'] = strtolower($_POST['showall']);
        header("Location:../");
    }
    if (isset($_POST['product'])) {
        $_SESSION['product'] = strtolower($_POST['product']);
        header("Location:../");
    }
    if (isset($_POST['order'])) { 
        require_once '../dbConfig.php';
        $sql = "INSERT INTO orders (`prod.category`, `prod.id`, `quantity`, `address`, `phoneNo`) VALUES ('" . $_SESSION['showall-table'] . "', '" . $_SESSION['product'] . "', '" . $_POST['quantity'] . "', '" . $_POST['addr'] . "', '" . $_POST['phn'] . "')";
        if ($conn->query($sql)) {
            $_SESSION['orderMsg'] = "Order Placed";
            header("Location:../");
        } else {
            $_SESSION['orderMsg'] = "Unable to process request";
            header("Location:../");
        }
    }
    if(isset($_POST['order-complete'])){
        require_once '../dbConfig.php';
        $conn->query("UPDATE orders SET completed = 1 WHERE id = ".$_POST['order-complete']);
        header("Location:../Dashboard.php");
    }
    if(isset($_POST['order-clear'])){
        require_once '../dbConfig.php';
        $conn->query("DELETE FROM orders WHERE id = ".$_POST['order-clear']);
        header("Location:../Dashboard.php");
    }
?>