<?php
    session_start();
    if( !isset($_SESSION['loggedIn']) ){
        $_SESSION['loggedIn'] = false;
    }

    require_once(__DIR__ . '/../classes/cart.php');
    if( !isset($_SESSION['cart']) ){

    }
?>