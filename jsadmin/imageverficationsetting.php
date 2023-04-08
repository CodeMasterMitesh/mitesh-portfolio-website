<?php
if (isset($_POST['save'])) {
    foreach ($_POST as $a => $b) {
        if ($a != 'save') {
            $sql = "replace into settings (`name`,`value`) values('" . $a . "','" . $b . "')";
            $q = mysql_query($sql) or die(mysql_error() . $sql);
        }
    }
    if ($q)
        echo "<script>alert('Setting saved');window.location='index.php?p=imageverficationsetting';</script>";
}

function getdata($name) {
    $sql1 = "select * from settings where name like '" . $name . "'";
    $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);
    $r = mysql_fetch_assoc($q1);
    return $r['value'];
}

//    $sql1="select * from settings where name like 'ship_%'";
//    $q1= mysql_query($sql1) or die(mysql_error().$sql1);    
//    while($r=  mysql_fetch_assoc($q1)){
//        debug($r);
//    }
?>



<form class="form-horizontal row-border"  method="post"  action="" novalidate="novalidate">
    <div>
        <div class="page-header" > 
            <div class="page-title"> <h3>Settings:Image Verfication </h3> </div> 
            <a href="index.php?p=shippingsetting">

            </a>
        </div> 
    </div>




    <div class="panel panel-default" style="vertical-align: top; margin-top: 10px;">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">Image Verfication</a> </h3>
        </div>
        <!--                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">-->
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="" style="border:none; vertical-align: top;">
                <!--                                    <div class="widget-content">-->

                <style>
                    .email_table td:nth-child(3){
                        padding-left: 25px;
                    }
                </style>
                <table style="width: 100%;line-height: 50px;" class="email_table">

                    <tr>

                        <td>
                            Image width:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            Image height:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            String length:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            Number of grid lines:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;"> 
                        </td>


                    </tr>
                    <tr>
                        <td>
                            Grid color (hexadecimal code):
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            Minimum font size:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;"> 
                        </td>


                    </tr>
                    <tr>
                        <td>
                            Maximum font size:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            String type:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;"> 
                        </td>


                    </tr>
                    <tr>
                        <td>
                            Character shadows:
                        </td>
                        <td>
                            <input type="radio"  name="" > Yes
                            <input type="radio"  name="" > No
                        </td>

                        <td>
                            Color:
                        </td>
                        <td>

                            <input type="radio"  name="" > Yes
                            <input type="radio"  name="" > No
                        </td>


                    </tr>
                    <tr>
                        <td>
                            Path to background image (relative to CS-Cart root directory):
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            Do not use verification if user is logged in:
                        </td>
                        <td>

                            <input type="radio"  name="" > Yes
                            <input type="radio"  name="" > No
                        </td>


                    </tr>
                    <tr>
                        <td>
                            Do not use verification after first valid answer:
                        </td>
                        <td>
                            <input type="radio"  name="" > Yes
                            <input type="radio"  name="" > No
                        </td>




                    </tr>


                </table>


            </div>
        </div>
    </div>
    <div class="tab-pane active" id="tab_1_1">

        <div class="widget">
            <div class="widget-content">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default" style="margin-left: -5px;">
                        <div class="panel-heading">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Use For </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 


                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        <style>
                                            .tables td:nth-child(3)
                                            {
                                                padding-left: 30px;
                                            }
                                        </style>
                                        <table style="width: 100%; vertical-align: top;line-height: 45px;" class="tables">
                                            <tr>
                                                <td>
                                                    Login form:
                                                </td>
                                                <td>
                                                    <input type="radio"  name="" > Yes
                                                    <input type="radio"  name="" > No
                                                </td>

                                                <td>
                                                    Create and edit profile form:
                                                </td>
                                                <td>

                                                    <input type="radio"  name="" > Yes
                                                    <input type="radio"  name="" > No
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>
                                                    Custom forms:
                                                </td>
                                                <td>
                                                    <input type="radio"  name="" > Yes
                                                    <input type="radio"  name="" > No
                                                </td>

                                                <td>
                                                    Send to friend form:
                                                </td>
                                                <td>

                                                    <input type="radio"  name="" > Yes
                                                    <input type="radio"  name="" > No
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>
                                                    Comments and reviews forms:
                                                </td>
                                                <td>
                                                    <input type="radio"  name="" > Yes
                                                    <input type="radio"  name="" > No
                                                </td>

                                                <td>
                                                    Checkout (user information) form:
                                                </td>
                                                <td>

                                                    <input type="radio"  name="" > Yes
                                                    <input type="radio"  name="" > No
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>
                                                    Polls:
                                                </td>
                                                <td>
                                                    <input type="radio"  name="" > Yes
                                                    <input type="radio"  name="" > No
                                                </td>

                                                <td>
                                                    Track my order form:
                                                </td>
                                                <td>

                                                    <input type="radio"  name="" > Yes
                                                    <input type="radio"  name="" > No
                                                </td>


                                            </tr>



                                        </table>




                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>




    <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

        <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="save" value="Save"/>

    </div>
</form>


