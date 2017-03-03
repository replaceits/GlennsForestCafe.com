<?php
    include('php/base/session.php');

    include('php/functions/getMenuCounts.php');

    $menuCount = getMenuCounts();
    $isOpen = false;

    // If its between Monday and Friday AND between 8:00 AM and 2:59 PM
    if(date('N') >= 1 && date('N') <= 5 && date('G') >= 8 && date('G') <= 14){
        $isOpen = true;
        // If it's after 2:29 PM
        if( date('G') == 14 && date('i') >= 30 ){
            $isOpen = false;
        }
    }



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('php/base/header.php'); ?>
    </head>

    <body>
        <?php include('php/layout/navbar.php'); ?>

        <div class="container">
            <div class="row">
                <!--Start Specials-->
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Todays Special</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-8 text-center">
                                                <div class="row">
                                                    <div class="col-xs-12 text-center">
                                                        Roast Beef turkey, swiss, LTM on sour dough w/side
                                                    </div>
                                                </div>
                                                <div class="spacer"></div>
                                                <div class="row">
                                                    <div class="col-xs-12 text-center">
                                                        <span class="glyphicon glyphicon-usd" aria-hidden="true"></span><strong>5.83</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <img src="images/sandwich.jpg" class="img-thumbnail" alt="Sandwich">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    <button class="btn btn-primary">Add to order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Todays Soup</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <img src="images/soup.jpeg" class="img-thumbnail" alt="Soup">
                                            </div>
                                            <div class="col-xs-8 text-center">
                                                <div class="row">
                                                    <div class="col-xs-12 text-center">
                                                        Mushroom
                                                    </div>
                                                </div>
                                                <div class="spacer"></div>
                                                <div class="row">
                                                    <div class="col-xs-12 text-center">
                                                        <span class="glyphicon glyphicon-usd" aria-hidden="true"></span><strong>2.37</strong>
                                                    </div>
                                                </div>
                                                <div class="spacer"></div>
                                                <div class="row">
                                                    <div class="col-xs-12 text-center">
                                                        Chicken Tortilla
                                                    </div>
                                                </div>
                                                <div class="spacer"></div>
                                                <div class="row">
                                                    <div class="col-xs-12 text-center">
                                                        <span class="glyphicon glyphicon-usd" aria-hidden="true"></span><strong>3.52</strong>
                                                    </div>
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
                    </div>
                </div>
                <!--End Specials-->
                <!--Menu-->
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Menu</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <a href="menu/?sandwiches=1" class="list-group-item">
                                            <span class="badge"><?php echo($menuCount["sandwiches"]); ?></span>
                                            Sandwiches
                                        </a>
                                        <a href="menu/?salads=1" class="list-group-item">
                                            <span class="badge"><?php echo($menuCount["salads"]); ?></span>
                                            Salads
                                        </a>
                                        <a href="menu/?wraps=1" class="list-group-item">
                                            <span class="badge"><?php echo($menuCount["wraps"]); ?></span>
                                            Wraps
                                        </a>
                                        <a href="menu/?sides=1" class="list-group-item">
                                            <span class="badge"><?php echo($menuCount["sides"]); ?></span>
                                            Sides
                                        </a>
                                        <a href="menu/?drinks=1" class="list-group-item">
                                            <span class="badge"><?php echo($menuCount["drinks"]); ?></span>
                                            Drinks
                                        </a>
                                        <a href="menu/?specials=1" class="list-group-item">
                                            <span class="badge"><?php echo($menuCount["specials"]); ?></span>
                                            Specials
                                        </a>
                                    </ul>
                                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                        <div class="btn-group" role="group">
                                            <a href="menu/" type="button" class="btn btn-default">Full Menu</a>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <a href="orders/" type="button" class="btn btn-default">Orders</a>
                                        </div>
                                        <div class="btn-group" role="group">
                                            <a href="cart/" type="button" class="btn btn-default">Cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Menu-->
                    <!--Contact Info-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Contact</h3>
                                </div>
                                <div class="panel-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>&nbsp;(804) 288-5410
                                        </li>
                                        <li class="list-group-item">
                                            <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp;7202 Glen Forest Dr # 104,
                                            <br>
                                            <span class="glyphicon glyphicon-map-marker" aria-hidden="true" style="visibility: hidden;"></span>&nbsp;Richmond, VA 23226
                                        </li>
                                        <li class="list-group-item alert alert-<?php echo($isOpen ? "success" : "danger" ); ?>" role="alert">
                                            <span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;Mon-Fri: 8:00AM - 2:30PM
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Contact Info-->
                </div>
            </div>
        </div>
    </body>
</html>