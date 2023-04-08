<?php
if (isset($_POST['save'])) {
    foreach ($_POST as $a => $b) {
        if ($a != 'save') {
            $sql = "replace into settings (`name`,`value`) values('" . $a . "','" . $b . "')";
            $q = mysql_query($sql) or die(mysql_error() . $sql);
        }
    }
    if ($q)
        echo "<script>alert('Setting saved');window.location='index.php?p=emailsetting';</script>";
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
            <div class="page-title"> <h3> New Status</h3> </div> 
            <a href="index.php?p=shippingsetting">

            </a>
        </div> 
    </div>




    <div class="panel panel-default" style="vertical-align: top; margin-top: 10px;">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">General </a> </h3>
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
                            Name:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            E-mail subject: 
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            E-mail header:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            Color
                        </td>
                        <td>
                            

                            <input type="radio"   <?php if (getdata('ship_dhl') == 'Yes') echo 'checked="checked"'; ?>  name="ship_dhl" value="Yes"> Yes &nbsp;

                            <input type="radio"  <?php if (getdata('ship_dhl') == 'No') echo 'checked="checked"'; ?>  name="ship_dhl" value="No"> NO
                        </td>

                    </tr>
                    <tr>
                        <td>
                            Notify customer
                        </td>
                        <td>
                            <input type="radio"   <?php if (getdata('ship_dhl') == 'Yes') echo 'checked="checked"'; ?>  name="ship_dhl" value="Yes"> Yes &nbsp;

                            <input type="radio"  <?php if (getdata('ship_dhl') == 'No') echo 'checked="checked"'; ?>  name="ship_dhl" value="No"> NO

                        </td>

                        <td>
                            Notify orders department
                        </td>
                        <td>

                            <input type="radio"   <?php if (getdata('ship_dhl') == 'Yes') echo 'checked="checked"'; ?>  name="ship_dhl" value="Yes"> Yes &nbsp;

                            <input type="radio"  <?php if (getdata('ship_dhl') == 'No') echo 'checked="checked"'; ?>  name="ship_dhl" value="No"> NO
                        </td>

                    </tr>
                    <tr>
                        <td>
                            Inventory
                        </td>
                        <td>
                            <select name="" class="form-control required has-error" style="border-radius: 6px;width:250px;">
                                <option value="not_active" selected="selected">Increase</option>
                                <option value="active">Decrease</option>
                            </select>
                        </td>

                        <td>
                            Remove CC info
                        </td>
                        <td>

                            <input type="radio"   <?php if (getdata('ship_dhl') == 'Yes') echo 'checked="checked"'; ?>  name="ship_dhl" value="Yes"> Yes &nbsp;

                            <input type="radio"  <?php if (getdata('ship_dhl') == 'No') echo 'checked="checked"'; ?>  name="ship_dhl" value="No"> NO
                        </td>

                    </tr>
                    <tr>
                        <td>
                            Pay order again
                        </td>
                        <td>
                             <input type="radio"   <?php if (getdata('ship_dhl') == 'Yes') echo 'checked="checked"'; ?>  name="ship_dhl" value="Yes"> Yes &nbsp;

                            <input type="radio"  <?php if (getdata('ship_dhl') == 'No') echo 'checked="checked"'; ?>  name="ship_dhl" value="No"> NO
                       
                        </td>

                        <td>
                            Invoice/Credit memo
                        </td>
                        <td>
                            <select name="" class="form-control required has-error" style="border-radius: 6px;width:250px;">
                                                <option value="D">Default</option>
                                                <option value="I">Invoice</option>
                                                <option value="C">Credit memo</option>
                                                <option value="O">Order</option>
                            </select>
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


