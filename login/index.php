<?php
    include('../php/base/session.php');

    $database_key = file_get_contents('/api-keys/database.key');

    $loggingIn            = false;
    $registering          = false;
    $emailSet             = false;
    $emailValid           = false;
    $passwordSet          = false;
    $passwordValid        = false;
    $passwordConfirmSet   = false;
    $passwordConfirmValid = false;
    $firstNameSet         = false;
    $firstNameValid       = false;
    $lastNameSet          = false;
    $lastNameValid        = false;
    $invalidLogin         = false;
    $invalidRegistration  = false;
    $valid_database       = true;
    $duplicateEmail       = false;

    $password        = "";
    $passwordConfirm = "";
    $passwordHash    = "";
    $email           = "";
    $firstName       = "";
    $lastName        = "";

    if( !$_SESSION['loggedIn'] ){
        if( isset($_POST['login']) ){
            $loggingIn = true;
        } else if( isset($_POST['register']) ){
            $registering = true;
        }

        if( $loggingIn || $registering ){
            if( isset($_POST['email']) && !empty($_POST['email']) ){
                $emailSet = true;

                $email = $_POST['email'];
                if( strlen($email) <= 255 && filter_var($email, FILTER_VALIDATE_EMAIL) ) {
                    $emailValid = true;
                }
            }

            if( isset($_POST['password']) && !empty($_POST['password']) ){
                $passwordSet   = true;

                $password = $_POST['password'];
                if( strlen($password) <= 255 ){
                    $passwordValid = true;
                }
            }

            if( $loggingIn && $emailValid && $passwordValid ){
                $mysqli_con = new mysqli("localhost","http",$database_key,"glennsforestcafe");

                if(!mysqli_connect_errno()){
                    $valid_database = true;

                    $sql = "SELECT user_first_name, user_last_name, user_password_hash FROM users WHERE user_email = ?;";

                    if($stmt = $mysqli_con->prepare($sql)){
                        $stmt->bind_param('s',$email);
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($firstName,$lastName,$password_hash);
                        
                        if($stmt->num_rows == 1){
                            $stmt->fetch();
                            if(password_verify($password,$password_hash)){
                                $invalidLogin = false;
                                $_SESSION['email'] = stripslashes(
                                                        htmlspecialchars(
                                                            trim($email)));
                                $_SESSION['loggedIn'] = true;
                                $_SESSION['firstName'] = stripslashes(
                                                            htmlspecialchars(
                                                                trim($firstName)));
                                $_SESSION['lastName'] = stripslashes(
                                                            htmlspecialchars(
                                                                trim($lastName)));
                            } else {
                                $invalidLogin = true;
                            }
                        } else {
                            $invalidLogin = true;
                        }
                        $stmt->close();
                    } else {
                        $valid_database = false;
                    }
                } else {
                    $valid_database = false;
                }
                $mysqli_con->close();
            }

            if( $registering ){
                if( isset($_POST['password_confirm']) && !empty($_POST['password_confirm']) ){
                    $passwordConfirmSet   = true;

                    $passwordConfirm = $_POST['password_confirm'];

                    
                    if( strlen($passwordConfirm) <= 255 && $passwordConfirm == $password ){
                        $passwordConfirmValid = true;
                        $passwordHash = password_hash($password,PASSWORD_BCRYPT);
                    }
                }

                if( isset($_POST['firstName']) && !empty($_POST['firstName']) ){
                    $firstNameSet = true;

                    $firstName = $_POST['firstName'];
                    if( strlen($firstName) <= 255 ){
                        $firstNameValid = true;
                    }
                }

                if( isset($_POST['lastName']) && !empty($_POST['lastName']) ){
                    $lastNameSet = true;

                    $lastName = $_POST['lastName'];
                    if( strlen($lastName) <= 255 ){
                        $lastNameValid = true;
                    }
                }

                if( $emailValid && $passwordValid && $passwordConfirmValid && $lastNameValid && $firstNameValid ){
                    $mysqli_con = new mysqli("localhost","http",$database_key,"glennsforestcafe");

                    if(!mysqli_connect_errno()){
                        $valid_database = true;

                        $sql = "SELECT user_email FROM users WHERE user_email = ?;";

                        if($stmt = $mysqli_con->prepare($sql)){
                            $stmt->bind_param('s',$email);
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($email_tmp);
                            
                            if($stmt->num_rows >= 1){
                                $stmt->fetch();
                                $duplicateEmail = true;
                                $invalidRegistration = true;
                            } else {
                                $duplicateEmail = false;
                            }
                            $stmt->close();
                        } else {
                            $valid_database = false;
                        }
                    } else {
                        $valid_database = false;
                    }
                    $mysqli_con->close();

                    if( !$duplicateEmail ){
                        $mysqli_con = new mysqli("localhost","http",$database_key,"glennsforestcafe");

                        if(!mysqli_connect_errno()){
                            $valid_database = true;

                            $sql = "INSERT INTO users(user_first_name, user_last_name, user_email, user_password_hash) VALUES(?,?,?,?);";

                            if($stmt = $mysqli_con->prepare($sql)){
                                $stmt->bind_param('ssss',$firstName,$lastName,$email,$passwordHash);
                                $stmt->execute();
                                $stmt->store_result();
                                
                                if($stmt->affected_rows >= 1){
                                    $invalidRegistration = false;
                                    $_SESSION['email'] = stripslashes(
                                                            htmlspecialchars(
                                                                trim($email)));
                                    $_SESSION['loggedIn'] = true;
                                    $_SESSION['firstName'] = stripslashes(
                                                                htmlspecialchars(
                                                                    trim($firstName)));
                                    $_SESSION['lastName'] = stripslashes(
                                                                htmlspecialchars(
                                                                    trim($lastName)));
                                } else {
                                    $invalidRegistration = true;
                                }
                                $stmt->close();
                            } else {
                                $valid_database = false;
                            }
                        } else {
                            $valid_database = false;
                        }
                        $mysqli_con->close();
                    }
                }
            }
            if( $loggingIn && !$invalidLogin || $registering && !$invalidRegistration ){
                header('Location: ' . dirname($_SERVER['REQUEST_URI']) . "/");
                exit(0);
            }
        }
    } else {
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
        <!--BEGIN ERRORS-->
        <?php
            if( ($loggingIn || $registering) && !$valid_database){
                ?>
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Hmm we're having some issues with our database...</div>
                    </div>
                <?php
            }
            else if( $loggingIn || $registering ){
                if( !$passwordSet ){
                ?>
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an empty password!</div>
                    </div>
                <?php
                } else if( !$passwordValid ){
                ?>
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an invalid password!</div>
                    </div>
                <?php
                }
                if( !$emailSet ){
                ?>
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an empty email!</div>
                    </div>
                <?php
                } else if( !$emailValid ){
                ?>
                    <div class="container">
                        <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an invalid email!</div>
                    </div>
                <?php
                }
                if($loggingIn){
                    if($invalidLogin){
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>We're sorry but we couldn't log you in.</div>
                        </div>
                    <?php
                    }
                }
                if($registering){
                    if( !$firstNameSet ){
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an empty first name!</div>
                        </div>
                    <?php
                    } else if( !$firstNameValid ){
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an invalid first name!</div>
                        </div>
                    <?php
                    }
                    if( !$lastNameSet ){
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an empty last name!</div>
                        </div>
                    <?php
                    } else if( !$lastNameValid ){
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an invalid last name!</div>
                        </div>
                    <?php
                    }
                    if( !$passwordConfirmSet ){
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an empty confirmation password!</div>
                        </div>
                    <?php
                    } else if( !$passwordConfirmValid ){
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>It looks like you submitted an invalid confirmation password!</div>
                        </div>
                    <?php
                    }
                    if($duplicateEmail){
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>An account with that email already exists!</div>
                        </div>
                    <?php
                    } else if($invalidRegistration){
                    ?>
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>We're sorry but we couldn't register you!</div>
                        </div>
                    <?php
                    }
                }
            }

            if( !$_SESSION['loggedIn'] ){
            ?>
                <!--END ERRORS-->
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
        <?php
            }
        ?>
    </body>
</html>