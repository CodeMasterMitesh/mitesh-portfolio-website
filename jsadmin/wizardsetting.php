<?php
if (isset($_POST['save'])) {
    foreach ($_POST as $a => $b) {
        if ($a != 'save') {
            $sql = "replace into settings (`name`,`value`) values('" . $a . "','" . $b . "')";
            $q = mysql_query($sql) or die(mysql_error() . $sql);
        }
    }
    if ($q)
        echo "<script>alert('Setting saved');window.location='index.php?p=loggingsetting';</script>";
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
            <div class="page-title"> <h3>Settings:Wizard</h3> </div> 
            <a href="index.php?p=shippingsetting">

            </a>
        </div> 
    </div>




    <div class="panel panel-default" style="vertical-align: top; margin-top: 10px;">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">logging</a> </h3>
        </div>
        <!--                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">-->
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="" style="border:none; vertical-align: top;">
                <!--                                    <div class="widget-content">-->

                <style>
                    .tables td:nth-child(3){
                        padding-left: 25px;
                    }
                </style>
                <table style="width: 100%; vertical-align: top;line-height: 45px;" class="tables">
                                            <tr>
                                                <td>
                                                   New administrator password:
                                                </td>
                                                <td>
                                                     <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                                                </td>

                                                <td>
                                                   SSL certificate
                                                </td>
                                                <td>

                                                     <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>
                                                  Enable secure connection at checkout:
                                                </td>
                                                <td>
                                                    <input type="checkbox"  name="" > Yes
                                                    <input type="checkbox"  name="" > No
                                                </td>

                                                <td>
                                                  Enable secure connection in the administration panel:
                                                </td>
                                                <td>

                                                     <input type="checkbox"  name="" > Yes
                                                    <input type="checkbox"  name="" > No
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>
                                                   Enable secure connection for authentication, profile and orders pages:
                                                </td>
                                                <td>
                                                     <input type="checkbox"  name="" > Yes
                                                    <input type="checkbox"  name="" > No
                                                </td>

                                                <td>
                                                 Minimum administrator password length:
                                                </td>
                                                <td>

                                                     <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>
                                                  Administrator password must contain both letters and numbers:
                                                </td>
                                                <td>
                                                     <input type="checkbox"  name="" > Yes
                                                    <input type="checkbox"  name="" > No
                                                </td>

                                                <td>
                                                   Force administrators to change password on the first login:
                                                </td>
                                                <td>

                                                     <input type="checkbox"  name="" > Yes
                                                    <input type="checkbox"  name="" > No
                                                </td>


                                            </tr>



                                        </table>
                


            </div>
        </div>
    </div>
    




    <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

        <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="save" value="Save"/>

    </div>
</form>


