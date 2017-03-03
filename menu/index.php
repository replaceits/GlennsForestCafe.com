<?php
    session_start();

    $getSandwiches = false;
    $getWraps      = false;
    $getSalads     = false;
    $getSides      = false;
    $getDrinks     = false;
    $getSpecials   = false;

    if( !($getSandwiches || $getWraps || $getSalads || $getSides || $getDrinks || $getSpecials) ){
        $getSandwiches = true;
        $getWraps      = true;
        $getSalads     = true;
        $getSides      = true;
        $getDrinks     = true;
        $getSpecials   = true;
    }



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../php/base/header.php'); ?>
    </head>

    <body>
        <?php include('../php/layout/navbar.php'); ?>
    </body>
</html>