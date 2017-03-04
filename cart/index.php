<?php
    require_once('../php/classes/item.php');
    require_once('../php/classes/cart.php');
    require_once('../php/base/session.php');
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
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cart</h3>
                        </div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <?php $_SESSION['cart']->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Costs</h3>
                        </div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <?php $_SESSION['cart']->renderCosts(); ?>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button class="btn btn-success" <?php if($_SESSION['cart']->getCount() === 0){echo("disabled");} ?>>Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
