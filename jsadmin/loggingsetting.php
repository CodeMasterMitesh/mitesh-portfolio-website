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
            <div class="page-title"> <h3>Settings:Logging </h3> </div> 
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
                    .email_table td:nth-child(3){
                        padding-left: 25px;
                    }
                </style>
                <table style="width: 100%; vertical-align: top;line-height: 45px;" class="tables">
                                            <tr>
                                                <td>
                                                    News:
                                                </td>
                                                <td>
                                                    <input type="checkbox"  name="" > Create
                                                    <input type="checkbox"  name="" > Delete
                                                    <input type="checkbox"  name="" > Update
                                                </td>

                                                <td>
                                                    Orders:
                                                </td>
                                                <td>

                                                    <input type="checkbox"  name="" > Change
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>
                                                   Users:
                                                </td>
                                                <td>
                                                    <input type="checkbox"  name="" > Session
                                                    <input type="checkbox"  name="" > Failed logins
                                                </td>

                                                <td>
                                                   Products:
                                                </td>
                                                <td>

                                                    <input type="checkbox"  name="" > Low stock
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>
                                                   Categories:
                                                </td>
                                                <td>
                                                    <input type="checkbox"  name="" > No items defined
                                                </td>

                                                <td>
                                                  Database:
                                                </td>
                                                <td>

                                                    <input type="checkbox"  name="" > Restore
                                                    <input type="checkbox"  name="" > Backup
                                                    <input type="checkbox"  name="" > Optimize
                                                    <input type="checkbox"  name="" > Errors
                                                </td>


                                            </tr>
                                            <tr>
                                                <td>
                                                   Requests:
                                                </td>
                                                <td>
                                                    <input type="checkbox"  name="" > HTTP/HTTPS
                                                </td>

                                                <td>
                                                    General:
                                                </td>
                                                <td>

                                                    <input type="checkbox"  name="" > Runtime
                                                    <input type="checkbox"  name="" > Deprecated features
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


