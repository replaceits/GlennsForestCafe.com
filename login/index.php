<?php
    include('../php/base/session.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../php/base/header.php'); ?>
    </head>

    <body>
        <?php include('../php/layout/navbar.php'); ?>
        <!--BEGIN LOGIN-->
        <form class="container" method="POST" action="login/">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
                                    <input type="email" class="form-control" autocomplete="email" placeholder="Email" aria-describedby="sizing-addon1" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" class="form-control" autocomplete="password" placeholder="Password" aria-describedby="sizing-addon2" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-primary" value="Login" name="login">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--END LOGIN-->
        <!--BEGIN REGISTRATION-->
        <form class="container" method="POST" action="login/">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Register</h3>
                </div>
                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <label>First Name</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon3"><span style="visibility:hidden;" class="glyphicon glyphicon-envelope"></span></span>
                                    <input type="text" class="form-control" autocomplete="firstName" placeholder="First Name" aria-describedby="sizing-addon3" name="firstName" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon4"><span style="visibility:hidden;" class="glyphicon glyphicon-envelope"></span></span>
                                    <input type="text" class="form-control" autocomplete="lastName" placeholder="Last Name" aria-describedby="sizing-addon4" name="lastName" required>
                                </div>
                            </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-envelope"></span></span>
                                    <input type="email" class="form-control" autocomplete="email" placeholder="Email" aria-describedby="sizing-addon1" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" class="form-control" autocomplete="password" placeholder="Password" aria-describedby="sizing-addon2" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Confirm Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" class="form-control" autocomplete="password" placeholder="Confirm Password" aria-describedby="sizing-addon2" name="password_confirm" required>
                                </div>
                            </div>
                        </div>
                        <div class="spacer"></div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-primary" value="Register" name="register">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--END REGISTRATION-->
    </body>
</html>