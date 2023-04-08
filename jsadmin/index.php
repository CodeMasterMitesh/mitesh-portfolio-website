<?php
include('../connection.php');
// include('../resizeimage.php');
if (!$_SESSION['udata'] && $page[0] != 'login.php') {
    header('Location:login.php');
}
if (isset($_POST['login'])) {
    $sql = "select * from clients where username like '" . $_POST['username'] . "', emailaddress like '" . $_POST['emailaddress'] . "' ";
    $q = mysql_query($sql) or die(mysql_error() . $sql);
    $r = mysql_fetch_assoc($q);
    //debug($r);
    if ($_POST['password'] && $r['password'] == $_POST['password']) {
        $_SESSION['udata'] = $r;
        $sql = "insert into clientlogin(uid,datetime) values('" . $r['id'] . "',now());";
        $q = mysql_query($sql) or die(mysql_error() . $sql);

        header('Location:index.php?p=product');
    } else {
        echo '<script>alert("Username & Password Not Valid ");</script>';
    }
}
if (isset($_GET['logout'])) {
    unset($_SESSION['udata']);
    session_destroy();
    header('Location:login.php');
}
?><html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Mitesh Prajapati | Website Admin Panel</title>



    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/main.css" rel="stylesheet" type="text/css" />
    <link href="css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="css/icons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/datatables.css">
    <link href="css/nestable.css" type="text/css" rel="stylesheet" />
    <link href="css/bootstrap-wysihtml5.css" type="text/css" rel="stylesheet" />
    <link href="css/select2.css" type="text/css" rel="stylesheet" />

    <!--        jqgrid-->
    <link rel="stylesheet" type="text/css" media="screen" href="css/Aristo/Aristo.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="jqgrid/themes/ui.jqgrid.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="jqgrid/themes/ui.multiselect.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lodash.compat.min.js"></script>

    <script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="js/jquery.event.move.js"></script>
    <script type="text/javascript" src="js/jquery.event.swipe.js"></script>
    <script type="text/javascript" src="js/breakpoints.js"></script>
    <script type="text/javascript" src="js/respond.min.js"></script>
    <script type="text/javascript" src="js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="js/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="js/jquery.slimscroll.horizontal.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/TableTools.min.js" type="text/javascript"></script>
    <script src="plugins/nestable/jquery.nestable.min.js.pagespeed.jm.LE0iEGqIZo.js"></script>


    <!--        <link href="css/W.main.css.pagespeed.cf.RKwtE1ncR7.css" type="text/css" rel="stylesheet">-->


    <!--[if lt IE 9]>-->
    <!--         <script type="text/javascript" src="plugins/flot/excanvas.min.js">
           </script>-->
    <!--<![endif]-->

    <script type="text/javascript" src="js/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/daterangepicker.js"></script>
    <script type="text/javascript" src="js/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="js/fullcalendar.min.js"></script>
    <script type="text/javascript" src="js/jquery.noty.js"></script>
    <script type="text/javascript" src="js/top.js"></script>
    <script type="text/javascript" src="js/default.js"></script>
    <script type="text/javascript" src="js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            //   $("#e1").select2();
            // $('.dropdown-menu').css("display", "none");
        })
    </script>

    <script type="text/javascript" src="js/app.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/plugins.form-components.js"></script>
    <script type="text/javascript" src="plugins/bootstrap-wysihtml5/wysihtml5.min.js"></script>
    <script type="text/javascript" src="plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.min.js"></script>
    <script>
        $(document).ready(function() {
            App.init();
            Plugins.init();
            FormComponents.init()
        });
    </script>
    <script type="text/javascript" src="plugins/datatables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/pages_calendar.js"></script>
    <!--    jqgrid-->
    <script src="jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script src="jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
    <script src="jqgrid/src/grid.common.js" type="text/javascript"></script>
    <script src="jqgrid/src/grid.setcolumns.js" type="text/javascript"></script>

    <script type="text/javascript">
        $.jgrid.no_legacy_api = true;
        $.jgrid.useJSON = true;
    </script>

    <script type="text/javascript" src="../js/globalize.js"></script>
    <script type="text/javascript" src="../js/globalize.cultures.js"></script>
    <script src="jqgrid/js/jquery.contextmenu.js" type="text/javascript"></script>
    <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="ckfinder/ckfinder.js" type="text/javascript"></script>

</head>

<body>
    <header class="header navbar navbar-fixed-top" role="banner">
        <div class="container">
            <ul class="nav navbar-nav">
                <li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
            </ul>
            <a class="navbar-brand" href="index.php"> <img src="images/logo.png" alt="logo" style="width: 50px;" /> </a>
            <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation"> <i class="icon-reorder"></i> </a>
            <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
                <li>
                    <a <?php
                        if (isset($_GET['p']) == "") {
                            echo 'class=""';
                        }
                        ?>href="index.php?p=dashboard"> Dashboard </a>
                </li>
                <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Marketing <i class="icon-caret-down small"></i> </a> 
                        <ul class="dropdown-menu" >
                            <!--                            <li>
                                                            <a href="#"><i class="icon-user"></i> Affiliates</a>
                                                            <ul class="subsideMenu2">
                                                                <li >
                            
                                                                </li>
                                                            </ul>
                                                        </li>-->
                <!-- <li><a href="index.php?p=promotion"><i class="icon-calendar"></i> Promotions</a></li>
                             <li class="divider"></li>
                            <li><a href="index.php?p=banner"><i class="icon-tasks"></i>Banners</a></li>
                            </ul>
                    </li>-->
            </ul>
            <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
            </ul>
            <!-- <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="icon-tasks"></i>Orders</a></li>
                </ul>
                </li>
            </ul> -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-male"></i> <span class="username" style="text-transform: uppercase;">
                            <?php
                            $sql = "select * from  login ";
                            $q = mysql_query($sql) or die(mysql_error() . $sql);
                            $r = mysql_fetch_assoc($q);
                            echo $r['username'];
                            ?>
                        </span> <i class="icon-caret-down small"></i> </a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?p=changepass"><i class="icon-user"></i> Change Password</a></li>
                        <li><a href="index.php?&logout=yes"><i class="icon-key"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div id="project-switcher" class="container project-switcher">
            <div id="scrollbar">
                <div class="handle"></div>
            </div>
            <div id="frame">
                <ul class="project-list">
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-desktop"></i></span> <span class="title">Lorem ipsum dolor</span> </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-compass"></i></span> <span class="title">Dolor sit invidunt</span> </a> </li>
                    <li class="current"> <a href="javascript:void(0);"> <span class="image"><i class="icon-male"></i></span> <span class="title">Consetetur sadipscing elitr</span>
                        </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-thumbs-up"></i></span> <span class="title">Sed diam nonumy</span> </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-female"></i></span> <span class="title">At vero eos et</span> </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-beaker"></i></span> <span class="title">Sed diam voluptua</span> </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-desktop"></i></span> <span class="title">Lorem ipsum dolor</span> </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-compass"></i></span> <span class="title">Dolor sit invidunt</span> </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-male"></i></span> <span class="title">Consetetur sadipscing elitr</span> </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-thumbs-up"></i></span> <span class="title">Sed diam nonumy</span> </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-female"></i></span> <span class="title">At vero eos et</span> </a> </li>
                    <li> <a href="javascript:void(0);"> <span class="image"><i class="icon-beaker"></i></span> <span class="title">Sed diam voluptua</span> </a> </li>
                </ul>
            </div>
        </div>
    </header>

    <div id="container">
        <div id="sidebar" class="sidebar-fixed">
            <div id="sidebar-content">
                <form class="sidebar-search">
                    <div class="input-box"> <button type="submit" class="submit"> <i class="icon-search"></i> </button>
                        <span><input type="text" placeholder="Search..." id="srch" /></span>
                    </div>
                </form>
                <div class="sidebar-search-results">
                    <i class="icon-remove close"></i>
                    <div id="srch-result"></div>
                </div>
                <script>
                    $('#srch').bind('keyup', function(e) {
                        if (e.keyCode == 13) {
                            $.ajax({
                                    type: "POST",
                                    url: "search.php",
                                    data: {
                                        q: $('#srch').val()
                                    }
                                })
                                .done(function(msg) {
                                    $('#srch-result').html(msg);
                                });
                        }
                    });
                </script>
                <ul id="nav">
                    <li> <a href="index.php?p=dashboard"> <i class="icon-dashboard"></i> Dashboard </a> </li>
                    <!-- <li>
                        <a href="javascript:void(0);"> <i class="icon-desktop"></i> Orders </a>
                        <ul class="sub-menu">
                            <li> <a href="index.php?p=orders"> <i class="icon-angle-right"></i> View orders </a> </li>
                        </ul>
                    </li> -->
                    <!-- <li>
                        <a href="javascript:void(0);"> <i class="icon-edit"></i> Customers </a>
                        <ul class="sub-menu">
                            <li> <a href="index.php?p=customer"> <i class="icon-angle-right"></i> Customers </a> </li>
                        </ul>
                    </li> -->
                    <!-- <li>
                        <a href="index.php?p=sizemaster"> <i class="icon-edit"></i> Size Master </a>

                    </li> -->
                    <li>
                        <a href=""> <i class="icon-list-ol"></i> Products</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="index.php?p=categories"> <i class="icon-globe"></i> Categories <span class="arrow"></span> </a>
                            </li>
                            <li class="open-default">
                                <a href="index.php?p=product"> <i class="icon-cogs"></i> Products <span class="arrow"></span></a>
                            </li>
                            <!-- <li>
                                <a href="index.php?p=stockfabric"> <i class="icon-cogs"></i> Ready Stock Fabric </a>
                            </li> -->
                            <li>
                                <a href="index.php?p=certificate"> <i class="icon-user"></i> Certificate </a>
                            </li>
                            <li>
                                <a href="index.php?p=banner"> <i class="icon-user"></i> Banner </a>
                            </li>

                        </ul>
                    </li>
                    <!-- <li>
                        <a href="javascript:void(0);"> <i class="icon-edit"></i> Feedback </a>
                        <ul class="sub-menu">
                            <li> <a href="index.php?p=feedback"> <i class="icon-angle-right"></i> Feedback </a> </li>
                        </ul>
                    </li> -->

                    <li>
                        <a href="javascript:void(0);"> <i class="icon-edit"></i> About Us</a>
                        <ul class="sub-menu">
                            <li> <a href="index.php?p=about"> <i class="icon-angle-right"></i> about </a> </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);"> <i class="icon-edit"></i> Blog</a>
                        <ul class="sub-menu">
                            <li> <a href="index.php?p=blog"> <i class="icon-angle-right"></i> Blog </a> </li>
                            <!-- <li> <a href="index.php?p=comments"> <i class="icon-angle-right"></i> Comment </a> </li> -->
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="javascript:void(0);"> <i class="icon-edit"></i> Newsletter </a>
                        <ul class="sub-menu">
                            <li> <a href="index.php?p=newsletter"> <i class="icon-angle-right"></i> Newsletter </a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
                <div class="sidebar-widget align-center">
                    <div class="btn-group" data-toggle="buttons" id="theme-switcher"> <label class="btn active"> <input type="radio" name="theme-switcher" data-theme="bright"><i class="icon-sun"></i> Bright
                        </label> <label class="btn"> <input type="radio" name="theme-switcher" data-theme="dark"><i class="icon-moon"></i> Dark </label> </div>
                </div>
            </div>
            <div id="divider" class="resizeable"></div>
        </div>

        <!--End of left menus-->
        <div id="content" style="padding: 10px;">


            <?php
            // if (file_exists(isset($_GET['p']) . '.php') && isset($_GET['p'])) {

            //     include($_GET['p'] . '.php');
            // } else {
            //     include('dashboard.php');
            // }
            // 
            ?>


            <?php

            if (isset($_GET['p']) && file_exists($_GET['p'] . '.php') && $_GET['p']) {

                include($_GET['p'] . '.php');
            } else {

                include('dashboard.php');
            }

            ?>
        </div>
    </div>