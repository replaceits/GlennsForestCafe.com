<?php
    session_start();

    include('../php/layout/menu.php');

    $menu = new Menu();
    $menu->parseGet();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../php/base/header.php'); ?>
    </head>

    <body>
        <?php include('../php/layout/navbar.php'); ?>

        <div class="container">
            <div class="row">
                <?php
                    $menu->render();
                ?>
            </div>
        </div>
    </body>
</html>