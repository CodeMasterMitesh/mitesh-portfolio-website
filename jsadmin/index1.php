<?php
include('../connection.php');
include('../resizeimage.php');
if (!$_SESSION['udata'] && $page[0] != 'login.php') {
    header('Location:login.php');
}
if ($_GET['logout']) {
    unset($_SESSION['udata']);
    session_destroy();
    header('Location:login.php');
}
?><html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
        <title>MOIPOT | JSTECHNO Ecommerce Admin Panel</title>

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>


        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <link href="css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="css/icons.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/datatables.css">
        <link href="css/nestable.css" type="text/css" rel="stylesheet"/>
        <link href="css/bootstrap-wysihtml5.css" type="text/css" rel="stylesheet"/>
        <link href="css/select2.css" type="text/css" rel="stylesheet"/>

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
                $("#e1").select2();
            });
        </script>
        <script type="text/javascript" src="js/app.js"></script> 
        <script type="text/javascript" src="js/plugins.js"></script> 
        <script type="text/javascript" src="js/plugins.form-components.js"></script>
        <script type="text/javascript" src="plugins/bootstrap-wysihtml5/wysihtml5.min.js"></script> 
        <script type="text/javascript" src="plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.min.js"></script>
        <script>$(document).ready(function() {
                App.init();
                Plugins.init();
                FormComponents.init()
            });</script> 
        <script type="text/javascript" src="plugins/datatables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
        <script type="text/javascript" src="js/pages_calendar.js"></script> 
        <script type="text/javascript" src="../ckeditor/ckeditor.js"></script>


        <script>
//    $(document).ready(function(){
//        ('.dropdown-menu').css("display","none");
//    })    
    </script>




    </head>
    <body>
        <header class="header navbar navbar-fixed-top" role="banner">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="nav-toggle"><a href="javascript:void(0);" title=""><i class="icon-reorder"></i></a></li>
                </ul>
                <a class="navbar-brand" href="index.php"> <img src="images/logo.png" alt="logo" style="width: 50px;"/>  </a> <a href="#" class="toggle-sidebar bs-tooltip" data-placement="bottom" data-original-title="Toggle navigation"> <i class="icon-reorder"></i> </a> 
                <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
                    <li> 
                        <a <?php
                        if ($_GET['p'] == "") {
                            echo 'class=""';
                        }
                        ?>href="index.php?p=dashboard"> Dashboard </a> </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Marketing <i class="icon-caret-down small"></i> </a> 
                        <ul class="dropdown-menu" >
<!--                            <li>
                                <a href="#"><i class="icon-user"></i> Affiliates</a>
                                <ul class="subsideMenu2">
                                    <li >

                                    </li>
                                </ul>
                            </li>-->
                            <li><a href="index.php?p=promotion"><i class="icon-calendar"></i> Promotions</a></li>
                             <li><a href="index.php?p=abandoned"><i class="icon-tasks"></i>Abandoned/Live Carts</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=banner"><i class="icon-tasks"></i>Banners</a></li>
                            <li><a href="index.php?p=gift"><i class="icon-user"></i> Gift Certificates</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=rewardpoint"><i class="icon-calendar"></i> Reward Points</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
                    <!--                    <li> <a href="#"> Dashboard </a> </li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Website <i class="icon-caret-down small"></i> </a> 
                        <ul class="dropdown-menu">
                            <li><a href="index.php?p=content"><i class="icon-user"></i> Content</a></li>
                            <li><a href="index.php?p=news"><i class="icon-calendar"></i> News</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=newsletter"><i class="icon-tasks"></i>Newsletters</a></li>
                            <li><a href="index.php?p=comments"><i class="icon-user"></i> Comment and Reviews</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=testimonial"><i class="icon-calendar"></i>Testimonials</a></li>
                            <li><a href="index.php?p=sitemap"><i class="icon-calendar"></i>Sitemap</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Add-ons <i class="icon-caret-down small"></i> </a> 
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="icon-user"></i> Manage Add-ons</a>
                            </li>
                            <li><a href="#"><i class="icon-calendar"></i> Data feeds</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-tasks"></i>Statistics</a></li>
                            <li><a href="#"><i class="icon-user"></i>Store locator</a></li>
                            <li><a href="index.php?p=livechat"><i class="icon-user"></i>Live Chat</a></li>
                            <li class="divider"></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Administration <i class="icon-caret-down small"></i> </a> 
                        <ul class="dropdown-menu">
                            <li><a href="index.php?p=stores"><i class="icon-user"></i> Stores</a>
                            </li>
                            <li><a href="index.php?p=payment"><i class="icon-calendar"></i> Payment methods</a></li>
                            <!--<li class="divider"></li>-->
                            <li class="dropdown-submenu   ">
                                <a href="index.php?p=shipping"><i class="icon-user"></i>Shipping &amp; taxes</a>
<!--                                <ul class="dropdown-menu">
                                    <li class="  ">
                                        <a href="http://demo.cs-cart.com/admin.php?dispatch=shippings.manage">Shipping methods</a>
                                    </li>
                                    <li class="  ">
                                        <a href="http://demo.cs-cart.com/admin.php?dispatch=taxes.manage">Taxes</a>
                                    </li>
                                    <li class="  ">
                                        <a href="http://demo.cs-cart.com/admin.php?dispatch=states.manage">States</a>
                                    </li>
                                    <li class="  ">
                                        <a href="http://demo.cs-cart.com/admin.php?dispatch=countries.manage">Countries</a>
                                    </li>
                                    <li class="  ">
                                        <a href="http://demo.cs-cart.com/admin.php?dispatch=destinations.manage">Locations</a>
                                    </li>
                                </ul>-->
                            </li>

                            <!--                            <li class="dropdown-submenu ">
                                                            <a href="index.php?p=shipping">
                                                                <i class="icon-tasks"></i>Shipping &amp; taxes</a>
                                                            <ul class="dropdown-menu">
                                                                <li class="  ">
                                                                    <a href="http://demo.cs-cart.com/admin.php?dispatch=shippings.manage">Shipping methods</a>
                                                                </li>
                                                                <li class="  ">
                                                                    <a href="http://demo.cs-cart.com/admin.php?dispatch=taxes.manage">Taxes</a>
                                                                </li>
                                                                <li class="  ">
                                                                    <a href="http://demo.cs-cart.com/admin.php?dispatch=states.manage">States</a>
                                                                </li>
                                                                <li class="  ">
                                                                    <a href="http://demo.cs-cart.com/admin.php?dispatch=countries.manage">Countries</a>
                                                                </li>
                                                                <li class="  ">
                                                                    <a href="http://demo.cs-cart.com/admin.php?dispatch=destinations.manage">Locations</a>
                                                                </li>
                                                            </ul>
                            
                                                        </li>-->
                            <li><a href="index.php?p=orderstatus"><i class="icon-user"></i>Order statuses</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=profilefield"><i class="icon-tasks"></i>Profile fields</a></li>
                            <li><a href="index.php?p=currencies"><i class="icon-user"></i>Currencies</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=language"><i class="icon-tasks"></i>Languages</a></li>
                            <li><a href="#"><i class="icon-user"></i>Logs</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-tasks"></i>Database</a></li>
                            <li><a href="#"><i class="icon-user"></i>Storage</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-tasks"></i>Import data</a></li>
                            <li><a href="#"><i class="icon-user"></i>Export data</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-tasks"></i>Import data</a></li>
                            <li><a href="#"><i class="icon-user"></i>Export data</a></li>
                            <li><a href="#"><i class="icon-tasks"></i>Upgrade center</a></li>
                            <li class="divider"></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <i class="icon-caret-down small"></i> </a> 
                        <ul class="dropdown-menu">
                            <li><a href="index.php?p=reports"><i class="icon-user"></i> Product</a>
                            </li>
                            <li><a href="#"><i class="icon-calendar"></i> Customer</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="icon-tasks"></i>Affiliates</a></li>
                            <li><a href="#"><i class="icon-user"></i>Sales</a></li>
                            <li class="divider"></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-left hidden-xs hidden-sm">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">  Settings <i class="icon-caret-down small"></i> </a> 
                        <ul class="dropdown-menu">
                            <li><a href="index.php?p=generalsetting"><i class="icon-user"></i> General</a>
                            </li>
                            <li><a href="index.php?p=appearance"><i class="icon-calendar"></i> Appearance</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=company"><i class="icon-tasks"></i>Company</a></li>
                            <li><a href="index.php?p=storesetting"><i class="icon-user"></i>Stores</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=shippingsetting"><i class="icon-tasks"></i>Shipping settings</a></li>
                            <li><a href="index.php?p=emailsetting"><i class="icon-user"></i>E-mails</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=thumbnailsetting"><i class="icon-tasks"></i>Thumbnails</a></li>
                            <li><a href="index.php?p=sitemapsetting"><i class="icon-user"></i>Sitemap</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=upgradesetting"><i class="icon-tasks"></i>Upgrade center</a></li>
                            <li><a href="index.php?p=securitysetting"><i class="icon-user"></i>Security settings</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=imageverficationsetting"><i class="icon-tasks"></i>Image verification</a></li>
                            <li><a href="index.php?p=loggingsetting"><i class="icon-user"></i>Logging</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?p=reports"><i class="icon-tasks"></i>Reports</a></li>
                            <li><a href="index.php?p=wizardsetting"><i class="icon-user"></i>Settings wizard</a></li>
                            <li><a href="index.php?p=storemodesetting"><i class="icon-tasks"></i>Store mode</a></li>
                            <li class="divider"></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-warning-sign"></i> <span class="badge">5</span> </a> 
                        <ul class="dropdown-menu extended notification">
                            <li class="title">
                                <p>You have 5 new notifications</p>
                            </li>
                            <li> <a href="javascript:void(0);"> <span class="label label-success"><i class="icon-plus"></i></span> <span class="message">New user registration.</span> <span class="time">1 mins</span> </a> </li>
                            <li> <a href="javascript:void(0);"> <span class="label label-danger"><i class="icon-warning-sign"></i></span> <span class="message">High CPU load on cluster #2.</span> <span class="time">5 mins</span> </a> </li>
                            <li> <a href="javascript:void(0);"> <span class="label label-success"><i class="icon-plus"></i></span> <span class="message">New user registration.</span> <span class="time">10 mins</span> </a> </li>
                            <li> <a href="javascript:void(0);"> <span class="label label-info"><i class="icon-bullhorn"></i></span> <span class="message">New items are in queue.</span> <span class="time">25 mins</span> </a> </li>
                            <li> <a href="javascript:void(0);"> <span class="label label-warning"><i class="icon-bolt"></i></span> <span class="message">Disk space to 85% full.</span> <span class="time">55 mins</span> </a> </li>
                            <li class="footer"> <a href="javascript:void(0);">View all notifications</a> </li>
                        </ul>
                    </li>
                    <li class="dropdown hidden-xs hidden-sm">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-tasks"></i> <span class="badge">7</span> </a> 
                        <ul class="dropdown-menu extended notification">
                            <li class="title">
                                <p>You have 7 pending tasks</p>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span class="task"> <span class="desc">Preparing new release</span> <span class="percent">30%</span> </span> 
                                    <div class="progress progress-small">
                                        <div style="width: 30%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span class="task"> <span class="desc">Change management</span> <span class="percent">80%</span> </span> 
                                    <div class="progress progress-small progress-striped active">
                                        <div style="width: 80%;" class="progress-bar progress-bar-danger"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span class="task"> <span class="desc">Mobile development</span> <span class="percent">60%</span> </span> 
                                    <div class="progress progress-small">
                                        <div style="width: 60%;" class="progress-bar progress-bar-success"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span class="task"> <span class="desc">Database migration</span> <span class="percent">20%</span> </span> 
                                    <div class="progress progress-small">
                                        <div style="width: 20%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                </a>
                            </li>
                            <li class="footer"> <a href="javascript:void(0);">View all tasks</a> </li>
                        </ul>
                    </li>
                    <li class="dropdown hidden-xs hidden-sm">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-envelope"></i> <span class="badge">1</span> </a> 
                        <ul class="dropdown-menu extended notification">
                            <li class="title">
                                <p>You have 3 new messages</p>
                            </li>
                            <li> <a href="javascript:void(0);"> <span class="photo"><img src="images/avatar-1.jpg" alt=""/></span> <span class="subject"> <span class="from">Bob Carter</span> <span class="time">Just Now</span> </span> <span class="text"> Consetetur sadipscing elitr... </span> </a> </li>
                            <li> <a href="javascript:void(0);"> <span class="photo"><img src="images/avatar-2.jpg" alt=""/></span> <span class="subject"> <span class="from">Jane Doe</span> <span class="time">45 mins</span> </span> <span class="text"> Sed diam nonumy... </span> </a> </li>
                            <li> <a href="javascript:void(0);"> <span class="photo"><img src="images/avatar-3.jpg" alt=""/></span> <span class="subject"> <span class="from">Patrick Nilson</span> <span class="time">6 hours</span> </span> <span class="text"> No sea takimata sanctus... </span> </a> </li>
                            <li class="footer"> <a href="javascript:void(0);">View all messages</a> </li>
                        </ul>
                    </li>
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
                            <li><a href="pages_calendar.html"><i class="icon-calendar"></i> My Calendar</a></li>
                            <li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>
                            <li class="divider"></li>
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
                        <li class="current"> <a href="javascript:void(0);"> <span class="image"><i class="icon-male"></i></span> <span class="title">Consetetur sadipscing elitr</span> </a> </li>
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
                                    data: {q: $('#srch').val()}
                                })
                                        .done(function(msg) {
                                    $('#srch-result').html(msg);
                                });
                            }
                        });
                    </script>
                    <ul id="nav">
                        <li > <a href="index.php?p=dashboard"> <i class="icon-dashboard"></i> Dashboard </a> </li>
                        <li>
                            <a href="javascript:void(0);"> <i class="icon-desktop"></i>  Orders </a> 
                            <ul class="sub-menu">
                                <li> <a href="index.php?p=orders"> <i class="icon-angle-right"></i> View orders </a> </li>
                                <li> <a href="index.php?p=salesreport"> <i class="icon-angle-right"></i> Sales reports </a> </li>
                                 <li> <a href="index.php?p=return"> <i class="icon-angle-right"></i> Returns </a> </li>
                                <li> <a href="index.php?p=recurringplans"> <i class="icon-angle-right"></i> Shipments </a> </li>
                                <li> <a href="index.php?p=recurringplans"> <i class="icon-angle-right"></i> Recurring plans </a> </li>
                                <li> <a href="index.php?p=recurringplans"> <i class="icon-angle-right"></i>View subscriptions </a> </li>
                                <li> <a href="index.php?p=recurringplans"> <i class="icon-angle-right"></i> Subscription events </a> </li>

                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> <i class="icon-edit"></i> Customers </a> 
                            <ul class="sub-menu">
                                <li> <a href="index.php?p=user"> <i class="icon-angle-right"></i> Users </a> </li>
                                <li> <a href="index.php?p=administrator"> <i class="icon-angle-right"></i> Administrators </a> </li>
                                <li> <a href="index.php?p=customer"> <i class="icon-angle-right"></i> Customers </a> </li>
                                <!--<li> <a href="index.php?p=user"> <i class="icon-angle-right"></i> Affiliates </a> </li>-->
                                <li> <a href="index.php?p=usergroup"> <i class="icon-angle-right"></i> User groups </a> </li>
                                <!--<li> <a href="index.php?p=user"> <i class="icon-angle-right"></i> Events </a> </li>-->
                            </ul>
                        </li>

                        <li>
                            <a href=""> <i class="icon-list-ol"></i> Products</a> 
                            <ul class="sub-menu">
                                <li class="open-default">
                                    <a href="index.php?p=product"> <i class="icon-cogs"></i> Products <span class="arrow"></span> </a> 

                                </li>
                                <li>
                                    <a href="index.php?p=categories"> <i class="icon-globe"></i> Categories <span class="arrow"></span> </a> 

                                </li>
                                <li> <a href="index.php?p=filters"> <i class="icon-folder-open"></i> Filters </a> </li>
                                <li> <a href="index.php?p=option"> <i class="icon-bell"></i> Options </a> </li>
                                <li>
                                    <a href="index.php?p=feature"> <i class="icon-user"></i> Features </a> 

                                </li>
                                <li>
                                    <a href="index.php?p=coupon"> <i class="icon-user"></i> Coupon  </a> 

                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="sidebar-title"> <span>Notifications</span> </div>
                    <ul class="notifications demo-slide-in">
                        <li style="display: none;">
                            <div class="col-left"> <span class="label label-danger"><i class="icon-warning-sign"></i></span> </div>
                            <div class="col-right with-margin"> <span class="message">Server <strong>#512</strong> crashed.</span> <span class="time">few seconds ago</span> </div>
                        </li>
                        <li style="display: none;">
                            <div class="col-left"> <span class="label label-info"><i class="icon-envelope"></i></span> </div>
                            <div class="col-right with-margin"> <span class="message"><strong>John</strong> sent you a message</span> <span class="time">few second ago</span> </div>
                        </li>
                        <li>
                            <div class="col-left"> <span class="label label-success"><i class="icon-plus"></i></span> </div>
                            <div class="col-right with-margin"> <span class="message"><strong>Emma</strong>'s account was created</span> <span class="time">4 hours ago</span> </div>
                        </li>
                    </ul>
                    <div class="sidebar-widget align-center">
                        <div class="btn-group" data-toggle="buttons" id="theme-switcher"> <label class="btn active"> <input type="radio" name="theme-switcher" data-theme="bright"><i class="icon-sun"></i> Bright </label> <label class="btn"> <input type="radio" name="theme-switcher" data-theme="dark"><i class="icon-moon"></i> Dark </label> </div>
                    </div>
                </div>
                <div id="divider" class="resizeable"></div>
            </div>

            <!--End of left menus-->
            <div id="content"  style="padding: 10px;">


                <?php
                if (file_exists($_GET['p'] . '.php') && $_GET['p']) {

                    include ($_GET['p'] . '.php');
                } else {
                    include ('dashboard.php');
                }
                ?>

            </div>
        </div>

        <script type="text/javascript" src="js/extra.js"></script> 