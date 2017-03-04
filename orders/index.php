<?php
    include('../php/base/session.php');
    include('../php/functions/orders.php');

    $orders = new Orders();

    if( !$_SESSION['loggedIn'] ){
        header('Location: ' . dirname($_SERVER['REQUEST_URI']) . "/");
        exit(0);
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
                <div class="col-md-8">
                    <div class="well">
                        Past Orders
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Your account</h3>
                        </div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        Name
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <input type="text" class="form-control text-center" value="<?php echo($_SESSION['firstName'] . " " . $_SESSION['lastName']); ?>" disabled>
                                    </div>
                                </div>
                                <div class="spacer"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Email
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <input type="text" class="form-control text-center" value="<?php echo($_SESSION['email']); ?>" disabled>
                                    </div>
                                </div>
                                <div class="spacer"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Total Orders
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <input type="text" class="form-control text-center" value="0" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <button class="btn btn-danger">Delete Account</button>
                            <button class="btn btn-primary hidden">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
