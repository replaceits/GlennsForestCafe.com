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

        <div class="container">
            <div class="row">
                <!--Start Drinks-->
                <div class="col-md-12">
                    <div class="well">Drinks</div>
                </div>
                <!--Start Coffee-->
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Coffee</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="images/default_coffee.jpeg" class="img-thumbnail" alt="coffee">
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="row">
                                        <div class="col-md-12">
                                            This is a cup of coffee
                                        </div>
                                        <div class="col-md-12">
                                            <span class="glyphicon glyphicon-usd" aria-hidden="true"></span><strong>1.25</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button class="btn btn-primary">Add to order</button>
                        </div>
                    </div>
                </div>
                <!--END COFFEE-->
                <!--Start Tea-->
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tea</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="images/default_tea.jpeg" class="img-thumbnail" alt="tea">
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="row">
                                        <div class="col-md-12">
                                            This is a cup of tea
                                        </div>
                                        <div class="col-md-12">
                                            <span class="glyphicon glyphicon-usd" aria-hidden="true"></span><strong>1.50</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button class="btn btn-primary">Add to order</button>
                        </div>
                    </div>
                </div>
                <!--END TEA-->
                <!--Start Drink-->
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Generic Soda</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="images/default_drink.jpg" class="img-thumbnail" alt="drink">
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="row">
                                        <div class="col-md-12">
                                            This is a can of something
                                        </div>
                                        <div class="col-md-12">
                                            <span class="glyphicon glyphicon-usd" aria-hidden="true"></span><strong>1.75</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button class="btn btn-primary">Add to order</button>
                        </div>
                    </div>
                </div>
                <!--END Drink-->
                <!--END Drinks-->
            </div>
        </div>
    </body>
</html>