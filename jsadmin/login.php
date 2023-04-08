<?php
include('../connection.php');
if (isset($_POST['username'])) {
    $sql = "select * from login where username like '" . $_POST['username'] . "' ";
    $q = mysql_query($sql) or die(mysql_error());
    $r = mysql_fetch_assoc($q);
    //                debug($r);
    //                exit;
    if ($r['id'] && $r['password'] == $_POST['password']) {
        $_SESSION['udata'] = $r;
        header('Location:index.php');
    }
}
if (isset($_SESSION['udata'])) {
    header('Location:index.php');
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Login
        |
        Mitesh Admin
    </title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/logins.css" rel="stylesheet" type="text/css" />
    <link href="css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="css/icons.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--                                                                                                                                                                                                        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>-->
    <!-- <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lodash.compat.min.js"></script> -->
    <!--[if lt IE 9]><script src="js/html5shiv.js"></script><![endif]-->
    <!-- <script type="text/javascript" src="js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/nprogress.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Login.init()
        });
    </script>
</head>

<body class="login">
    <!-- <div class="logo">
        <img src="images/logo.png" alt="logo" />
    </div> -->
    <!-- <div class="box">
        <div class="content">
            <form action="" method="post">
                <h3 class="form-title">Sign Into your Account
                </h3>
                <div class="alert fade in alert-danger" style="display: none;">
                    <i class="icon-remove close" data-dismiss="alert"></i>Enter any username and password.
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="icon-user"></i>
                        <input type="text" name="username" class="form-control" placeholder="Username" autofocus="autofocus" data-rule-required="true" data-msg-required="Please enter your username." />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <i class="icon-lock"></i>
                        <input type="password" name="password" class="form-control" placeholder="Password" data-rule-required="true" data-msg-required="Please enter your password." />
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit btn btn-primary pull-right">Sign In
                        <i class="icon-angle-right"></i>
                    </button>
                </div>
            </form>

        </div>
        <div class="inner-box">
            <div class="content">
                <i class="icon-remove close hide-default"></i>
                <form class="form-vertical forgot-password-form hide-default" action="" method="post">
                    <div class="form-group">
                        <div class="input-icon">
                            <i class="icon-envelope"></i>
                            <input type="text" name="email" class="form-control" placeholder="Enter email address" data-rule-required="true" data-rule-email="true" data-msg-required="Please enter your email." />
                        </div>
                    </div>
                    <button type="submit" class="submit btn btn-default btn-block">Reset your Password</button>
                </form>
                <div class="forgot-password-done hide-default">
                    <i class="icon-ok success-icon"></i> <span>Great. We have sent you an email.</span>
                </div>
            </div>
        </div>
    </div> -->

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Sign Into your Account</h2>
                <!-- <div class="text-center mb-5 text-dark">Made with bootstrap</div> -->
                <div class="card my-5">

                    <form class="card-body cardbody-color p-lg-5" action="" method="post">

                        <div class="text-center">
                            <img src="images/logo.png" alt="logo" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" id="Username" aria-describedby="emailHelp" placeholder="User Name">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        </div>
                        <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                            Registered? <a href="#" class="text-dark fw-bold"> Create an
                                Account</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>