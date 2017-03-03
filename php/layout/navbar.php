<div class="full-background"></div>
<header class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="">Glenn's Forest Cafe</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" role="navigation">
            <ul class="nav navbar-nav navbar-center">
                <li><a href="about/"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;About<span class="sr-only">&nbsp;(current)</span></a></li>
                <li><a href="location/"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp;Location</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span>&nbsp;Menu&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="menu/">All</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="menu/?sandwiches=1">Sandwiches</a></li>
                        <li><a href="menu/?wraps=1">Wraps</a></li>
                        <li><a href="menu/?salads=1">Salads</a></li>
                        <li><a href="menu/?sides=1">Sides</a></li>
                        <li><a href="menu/?drinks=1">Drinks</a></li> 
                        <li role="separator" class="divider"></li>
                        <li><a href="menu/?specials=1">Specials</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="menu/download/">Download menu&nbsp;&nbsp;<span class="glyphicon glyphicon-download" aria-hidden="true"></span></a></li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-right" role="navigation">
                <ul class="nav navbar-nav">
                    <?php
                        if($_SESSION['loggedIn']){
                    ?>
                        <li>
                            <a href="orders/">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<?php echo($_SESSION['firstName'] . " " . $_SESSION['lastName']); ?>
                            </a>
                        </li>
                    <?php
                        } else {
                    ?>
                        <li>
                            <a href="login/">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Login/Register
                            </a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="cart/">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp;Cart&nbsp;&nbsp;<span class="cart-header-items badge">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>