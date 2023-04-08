<?php
if (isset($_POST['save'])) {
    foreach($_POST as $a=>$b)
    {
        if($a!='save'){
        $sql="replace into settings (`name`,`value`) values('".$a."','".$b."')";        
        $q = mysql_query($sql) or die(mysql_error().$sql);
        }
    }
    if ($q)
        echo "<script>alert('Setting saved');window.location='index.php?p=shippingsetting';</script>";
}
function  getdata($name)
{
    $sql1="select * from settings where name like '".$name."'";
    $q1= mysql_query($sql1) or die(mysql_error().$sql1);    
    $r=  mysql_fetch_assoc($q1);
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
            <div class="page-title"> <h3> Shipping settings</h3> </div> 
            <a href="index.php?p=shippingsetting">

            </a>
        </div> 

        <table style="width: 30%; vertical-align: top;">

            <tr>
                <td>
                    Disable shipping: 
                </td>
                <td>

                    <input type="radio" <?php if(getdata('ship_disable')=='Yes')echo 'checked="checked"';?> name="ship_disable" value="Yes"> Yes &nbsp;

                    <input type="radio" <?php if(getdata('ship_disable')=='No')echo 'checked="checked"';?> name="ship_disable" value="No"> NO

                </td>
            </tr>
        </table>





    </div>




    <div class="panel panel-default" style="vertical-align: top; margin-top: 10px;">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">Shipping processors </a> </h3>
        </div>
        <!--                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">-->
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="" style="border:none; vertical-align: top;">
                <!--                                    <div class="widget-content">-->


                <table style="width: 100%;line-height: 50px;">

                    <tr>

                        <td>
                            Enable FedEx: 
                        </td>
                        <td>

                            <input type="radio" <?php if(getdata('ship_fedex')=='Yes')echo 'checked="checked"';?> name="ship_fedex" value="Yes">  Yes &nbsp;


                            <input type="radio" <?php if(getdata('ship_fedex')=='No')echo 'checked="checked"';?> name="ship_fedex" value="No"> NO</label>
                        </td>

                        <td>
                            Enable UPS:   
                        </td>
                        <td>

                            <input type="radio"  <?php if(getdata('ship_ups')=='Yes')echo 'checked="checked"';?> name="ship_ups" value="Yes"> Yes &nbsp;


                            <input type="radio" <?php if(getdata('ship_ups')=='No')echo 'checked="checked"';?> name="ship_ups" value="No"> NO

                        </td>
                    </tr>

                    <tr>
                        <td>
                            Enable USPS: 
                        </td>
                        <td>

                            <input type="radio"  <?php if(getdata('ship_usps')=='Yes')echo 'checked="checked"';?>  name="ship_usps" value="Yes"> Yes &nbsp;


                            <input type="radio" <?php if(getdata('ship_usps')=='No')echo 'checked="checked"';?>  name="ship_usps" value="No" > NO

                        </td>

                        <td>
                            Enable DHL:
                        </td>
                        <td>

                            <input type="radio"   <?php if(getdata('ship_dhl')=='Yes')echo 'checked="checked"';?>  name="ship_dhl" value="Yes"> Yes &nbsp;

                            <input type="radio"  <?php if(getdata('ship_dhl')=='No')echo 'checked="checked"';?>  name="ship_dhl" value="No"> NO
                        </td>

                    </tr>

                    <tr>
                        <td>
                            Enable Australia Post:
                        </td>
                        <td>

                            <input type="radio"  <?php if(getdata('ship_austpost')=='Yes')echo 'checked="checked"';?>  name="ship_austpost" value="Yes"> Yes &nbsp;


                            <input type="radio"  <?php if(getdata('ship_austpost')=='No')echo 'checked="checked"';?>  name="ship_austpost" value="No"> NO

                        </td>

                        <td>
                            Enable Canada Post: 
                        </td>
                        <td>

                            <input type="radio"  <?php if(getdata('ship_canpost')=='Yes')echo 'checked="checked"';?>  name="ship_canpost" value="Yes"> Yes &nbsp;


                            <input type="radio"  <?php if(getdata('ship_canpost')=='No')echo 'checked="checked"';?>  name="ship_canpost" value="No"> NO

                        </td>
                    </tr>

                    <tr>
                        <td>
                            Enable Swiss Post:  
                        </td>
                        <td>

                            <input type="radio"  <?php if(getdata('ship_swisspost')=='Yes')echo 'checked="checked"';?>  name="ship_swisspost" value="Yes"> Yes &nbsp;


                            <input type="radio"  <?php if(getdata('ship_swisspost')=='No')echo 'checked="checked"';?>  name="ship_swisspost" value="No"> NO &nbsp;
                        </td>

                        <td>
                            Enable Temando:  
                        </td>
                        <td>

                            <input type="radio"  <?php if(getdata('ship_temanpost')=='Yes')echo 'checked="checked"';?>  name="ship_temanpost" value="Yes"> Yes &nbsp;


                            <input type="radio"  <?php if(getdata('ship_temanpost')=='No')echo 'checked="checked"';?>  name="ship_temanpost" value="No"> NO &nbsp;

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


